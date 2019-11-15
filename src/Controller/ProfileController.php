<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\User;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profile")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/")
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function view(/*EntityManagerInterface $em*/)
    {
        /** @var User $user */
//        $userList = $em->getRepository(User::class)->findByExampleField();
        $user = $this->getUser();
        $dataUser = [
            'phone' => $user->getPhone(),
            'first name' => $user->getFirstName(),
            'last name' => $user->getLastName(),
            'id' => $user->getId()
        ];
        return $this->render('profile/profile.html.twig', [
//            'userList' => $userList,
            'phone' => $dataUser['phone'],
            'first_name' => $dataUser['first name'],
            'last_name' => $dataUser['last name'],
            'id' => $dataUser['id'],
        ]);
    }
}
