<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class AuthViewController extends AbstractController
{

    use TargetPathTrait;

    /**
     * @Route("/", name="main_page")
     */
    public function mainPage()
    {
        if ($security->isGranted('ROLE_USER')){
            return $this->redirectToRoute('profile_page');
        }

    }
}