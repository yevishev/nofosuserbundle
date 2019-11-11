<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RegViewController extends AbstractController
{
    /**
     * @Route("/registration", name="register_index")
     */
    public function viewReg()
    {
        return $this->render('registration/reg.html.twig');
    }
}