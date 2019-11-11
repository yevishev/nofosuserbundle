<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfileViewController extends AbstractController
{
     /**
      * @Route("/profile", name="profile_index")
      */
    public function viewProfile()
    {
        return $this->render('profile/profile.html.twig');
    }
}
