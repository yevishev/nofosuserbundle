<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profile")
 */
class ProfileController extends AbstractController
{
     /**
      * @Route("/")
      */
    public function view()
    {
        /** @var User $user */
        $user = $this->getUser();
        $dataUser = [
            'phone' => $user->getPhone(),
            'first name' => $user->getFirstName(),
            'last name' => $user->getLastName(),
            'id' => $user->getId()
        ];
        return $this->render('profile/profile.html.twig', [
            'phone' => $dataUser['phone'],
            'first_name' => $dataUser['first name'],
            'last_name' => $dataUser['last name'],
            'id' => $dataUser['id'],
        ]);
    }
}
