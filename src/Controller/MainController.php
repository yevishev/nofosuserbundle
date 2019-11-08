<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController
{
    /**
     * @Route("/")
     */
    public function number()
    {
        $number = random_int(0, 100);
        return new Response(
            '<html><body>Num is: '.$number.'</body></html>'
        );
    }
}