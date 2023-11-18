<?php

namespace App\Controller;

use App\Entity\Phone;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/users')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }











//    #[Route('/generate', name: 'generate_users')]
//    public function generate(EntityManagerInterface $em): Response
//    {
//        $users = [
//            [
//                'login' => 'Maks',
//                'pass' => '123123',
//                'status' => User::STATUS_ACTIVE,
//                'phones' => [
//                    '+380685508373',
//                    '+380685508322',
//                ]
//            ],
//            [
//                'login' => 'Devoid',
//                'pass' => '123321',
//                'status' => User::STATUS_VIP,
//                'phones' => [
//                    '+380685508383',
//                ]
//            ],
//            [
//                'login' => 'Nick',
//                'pass' => '321321',
//                'status' => User::STATUS_DISABLED,
//                'phones' => [
//                    '+380685508133',
//                ]
//            ],
//        ];
//
//        foreach ($users as $user) {
//            $userObj = new User($user['login'], $user['pass'], $user['status']);
//            $em->persist($userObj);
//
//            foreach ($user['phones'] as $phone) {
//                $phoneObj = new Phone($userObj, $phone);
//                $em->persist($phoneObj);
//            }
//        }
//        $em->flush();
//
//        return new Response('OK');
//    }
}
