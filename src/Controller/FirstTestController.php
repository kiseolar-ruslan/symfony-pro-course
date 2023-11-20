<?php

namespace App\Controller;

use App\Entity\User;
use App\Services\TestInterface\TestInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstTestController extends AbstractController
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
    public function redirectToLuckyPage(Request $request): RedirectResponse
    {
        return $this->redirectToRoute(
            'lucky_number',
            ['max' => 10],
            Response::HTTP_MOVED_PERMANENTLY
        );
    }

    #[Route('/test/interface', name: 'test_interface', methods: 'GET')]
    public function testInterface(
        #[Autowire(service: 'App\Services\TestInterface\FirstTestChild')] TestInterface $service
    ): Response {
        return new Response($service->printMessage());
    }

    #[Route('/error/{id}', name: 'managing_errors', methods: 'GET')]
    public function managingErrors(User $user, EntityManagerInterface $em): Response
    {
        $userFromDB = $em->getRepository(User::class)
                         ->findOneBy(['id' => $user]);

        if (true === is_null($userFromDB)) {
            throw $this->createNotFoundException('The user does not exist!');
        }

        return new Response(200);
    }

    #[Route('/request/object', name: 'request_obj', methods: 'GET')]
    public function requestObj(Request $request): Response
    {
        $page = $request->query->get('page', 1);

        return new Response(200);
    }
}
