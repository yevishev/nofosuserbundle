<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profile")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/")
     * @return Response
     */

    public function view(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $dataUser = [
            'phone' => $user->getPhone(),
            'first name' => $user->getFirstName(),
            'last name' => $user->getLastName(),
            'company' => $user->getCompany()->getNameCompany(),
            'inviter_fn' => $user->getInviter()->getFirstName(),
            'inviter_ln' => $user->getInviter()->getLastName(),
        ];
        return $this->render('profile/profile.html.twig', [
            'phone' => $dataUser['phone'],
            'first_name' => $dataUser['first name'],
            'last_name' => $dataUser['last name'],
            'company' => $dataUser['company'],
            'inviter_fn' => $dataUser['inviter_fn'],
            'inviter_ln' => $dataUser['inviter_ln'],
        ]);
    }
}
