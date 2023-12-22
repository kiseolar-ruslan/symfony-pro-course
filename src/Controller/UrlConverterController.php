<?php

namespace App\Controller;

use App\Entity\UrlCode;
use App\Services\CodePairService;
use App\Services\IncrementAndSaveEntityService;
use App\UrlConverter\Interfaces\IUrlEncoder;
use PHPUnit\Util\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;

#[Route('/url')]
class UrlConverterController extends AbstractController
{
    #[Route('/encode', name: 'url_encode', requirements: ['url' => '(http|https|ftp):\/\/.*'], methods: 'POST')]
    public function urlEncode(Request $request, IUrlEncoder $converter): RedirectResponse
    {
        $url = $request->get('url');
        $code = $converter->encode($url);

        return $this->redirectToRoute('url_decode', ['code' => $code]);
    }

    #[Route('/{code}/statistic', name: 'url_decode', requirements: ['code' => '[a-zA-Z0-9]+'], methods: 'GET')]
    public function urlDecode(UrlCode $urlCodeEntity): Response
    {
        // if user un-authorised throw exception
        if ($this->getUser() !== $urlCodeEntity->getUser()) {
            throw new Exception('No access!');
        }

        return $this->render('url_converter/url_info.html.twig', [
            'url_code' => $urlCodeEntity,
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
