<?php

namespace App\Controller;

use App\UrlConverter\Interfaces\IUrlDecoder;
use App\UrlConverter\Interfaces\IUrlEncoder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/url')]
class UrlConverterController extends AbstractController
{
    #[Route('/encode/{url}', name: 'url_encode', requirements: ['url' => 'http.*'], methods: 'GET')]
    public function testUrlEncode(string $url, IUrlEncoder $converter): Response
    {
        $code = $converter->encode($url);

        return $this->render('url_converter/show_code.html.twig', [
            'code' => $code,
        ]);
    }

    #[Route('/decode/{code}', name: 'url_decode', methods: 'GET')]
    public function testUrlDecode(string $code, IUrlDecoder $converter): Response
    {
        $url = $converter->decode($code);

        return $this->render('url_converter/show_url.html.twig', [
            'url' => $url,
        ]);
    }
}
