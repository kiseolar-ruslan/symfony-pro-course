<?php

namespace App\Controller;

use App\Entity\User;
use App\Services\TestInterface\TestInterface;
use App\UrlConverter\Interfaces\IUrlDecoder;
use App\UrlConverter\Interfaces\IUrlEncoder;
use App\UrlConverter\UrlConverter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/lucky/number/{max}', name: 'lucky_number', methods: 'GET')]
    public function luckyNumber(int $max): Response
    {
        $randNum = rand(0, $max);

        return $this->render('user/lucky_number.html.twig', [
            'randNum' => $randNum,
        ]);
    }

    #[Route('/redirect/to/lucky', name: 'redirect_to_lucky_page', methods: 'GET')]
    public function redirectToLuckyPage(): RedirectResponse
    {
        return $this->redirectToRoute(
            'lucky_number',
            ['max' => 10],
            Response::HTTP_MOVED_PERMANENTLY
        );
    }

    #[Route('/test/interface', name: 'test_interface', methods: 'GET')]
    public function testInterface(
        //#[Autowire(service: 'App\Services\TestInterface\FirstTestChild')]
        TestInterface $service
    ): Response {
        return new Response($service->printMessage());
    }

    #[Route('/error/{id}', name: 'managing_errors', methods: 'GET')]
    public function managingErrors(User $user, EntityManagerInterface $em): Response
    {
        $userFromDB = $em->getRepository(User::class)->findOneBy(['id' => $user]);

        if (true === is_null($userFromDB)) {
            throw $this->createNotFoundException('The user does not exist!');
        }

        return new Response(200);
    }

    #[Route('/request/object', name: 'request_obj', methods: 'GET')]
    public function requestObj(Request $request): Response
    {
        $page = $request->getUser();

        return new Response($page);
    }

    #[Route('/test', name: 'test_post', methods: 'POST')]
    public function testPostMethod(Request $request): Response
    {
        $url = $request->get('url');
        dd($request);
        return new Response($url);
    }

    #[Route('/test2', name: 'test_post2', methods: 'GET')]
    public function test2PostMethod(): Response
    {
        return $this->render('first_test/testPost.twig');
    }
}
