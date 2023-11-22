<?php

declare(strict_types=1);

namespace App\UrlConverter;

use App\UrlConverter\Interfaces\ICodeRepository;
use App\UrlConverter\Interfaces\ISaveData;
use App\UrlConverter\Interfaces\IUrlDecoder;
use App\UrlConverter\Interfaces\IUrlEncoder;
use App\UrlConverter\Interfaces\IUrlValidator;
use InvalidArgumentException;

class UrlConverter implements IUrlEncoder, IUrlDecoder
{
    protected const CODE_LENGTH = 5;

    protected const FILE_NAME = 'url.json';

    public function __construct(
        protected ICodeRepository $repository,
        protected ISaveData       $saveData,
        protected IUrlValidator   $validator,
        protected int             $codeLength = self::CODE_LENGTH,
    ) {
    }

    /**
     * @throws InvalidArgumentException
     */
    public function encode(string $url): string
    {
        $this->validateUrl($url);

        try {
            $code = $this->repository->getCodeByUrl($url);
        } catch (InvalidArgumentException) {
            $code = $this->generateAndSaveCode($url);
        }

        return $code;
    }

    public function decode(string $code): string
    {
        return $this->repository->getUrlByCode($code);
    }

    /**
     * @throws InvalidArgumentException
     */
    protected function generateAndSaveCode(string $url): string
    {
        $inputUrl = $url;
        $code     = $this->generateCode($url);
        $preparedData[$code] = $inputUrl;
        $this->saveData->saveData($preparedData);

        return $code;
    }

    protected function generateCode(string $url): string
    {
        $time    = time();
        $randNum = rand(0, 9);
        $lowerCaseCode = hash('sha256', $time . $url . $randNum);
        return substr(mb_strtoupper($lowerCaseCode), 0, $this->codeLength);
    }

    protected function validateUrl(string $url): bool
    {
        return $this->validator->validateUrl($url);
    }
}