<?php

namespace App\Controller;

use App\Entity\UrlCode;
use App\Services\CodePairService;
use App\Services\IncrementAndSaveEntityService;
use App\UrlConverter\Interfaces\IUrlDecoder;
use App\UrlConverter\Interfaces\IUrlEncoder;
use App\UrlConverter\UrlConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;

#[Route('/url')]
class UrlConverterController extends AbstractController
{
    #[Route('/encode/{url}', name: 'url_encode', requirements: ['url' => '(http|https|ftp):\/\/.*'], methods: 'GET')]
    public function urlEncode(string $url, IUrlEncoder $converter): Response
    {
        $code = $converter->encode($url);

        return $this->render('url_converter/show_code.html.twig', [
            'code' => $code,
        ]);
    }

    #[Route('/decode/{code}', name: 'url_decode', requirements: ['code' => '[a-zA-Z0-9]+'], methods: 'GET')]
    public function urlDecode(string $code, IUrlDecoder $converter): Response
    {
        $url = $converter->decode($code);

        return $this->render('url_converter/show_url.html.twig', [
            'url' => $url,
        ]);
    }

    #[Route('/statistic', name: 'all_statistic', methods: 'GET')]
    public function allStatistic(CodePairService $codePairService): Response
    {
        // if user un-authorised used redirect
        if (false === $this->isGranted('ROLE_USER')) {
            throw new AuthenticationCredentialsNotFoundException();
        }

        return $this->render('url_converter/all_url_codes.html.twig', [
            'url_codes' => $codePairService->getAllObjects($this->getUser()),
        ]);
    }

    #[Route('/{code}', name: 'short_url', requirements: ['code' => '[a-zA-Z0-9]+'], methods: 'GET')]
    public function urlRedirect(
        UrlCode                       $urlCodeEntity,
        IncrementAndSaveEntityService $incrementAndSave
    ): RedirectResponse {
        $incrementAndSave->increment($urlCodeEntity);
        return $this->redirect($urlCodeEntity->getUrl());
    }
}
