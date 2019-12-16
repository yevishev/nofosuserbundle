<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainpageController extends AbstractController
{
    /**
     *
     * @Route("/")
     */
    function view()
    {
        if($this->isGranted('IS_AUTHENTICATED_REMEMBERED')){
            return $this->redirectToRoute('app_profile_view');
        }
        return $this->render('mainpage/mainpage.html.twig');
    }
}