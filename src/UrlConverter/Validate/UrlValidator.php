<?php

declare(strict_types=1);

namespace App\UrlConverter\Validate;

use App\UrlConverter\Interfaces\IUrlValidator;
use InvalidArgumentException;

class UrlValidator implements IUrlValidator
{
    public function validateUrl(string $url): bool
    {
        $allowedCodes = [
            '200 OK',
            '201 Created',
            '301 Moved Permanently',
            '302 Found',
        ];

        $isValid = false;

        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new InvalidArgumentException('The URL is invalid');
        }

        //Returns an array with the headers sent by the server in response to an HTTP request.
        $allResponses = get_headers($url);

        if ($allResponses === false) {
            throw new InvalidArgumentException('The URL is invalid');
        }

        foreach ($allowedCodes as $allowedCode) {
            if (in_array("HTTP/1.1 $allowedCode", $allResponses) === true) {
                $isValid = true;
                break;
            }
        }

        if ($isValid === false) {
            throw new InvalidArgumentException('The URL is invalid');
        }

        return true;
    }
}