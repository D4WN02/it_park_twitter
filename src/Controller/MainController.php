<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends Controller
{
    /**
     * @Route("/main", name="main")
     */
    public function index()
    {
        $array = [1,2,3,4,5,6,7,8,9,0];
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'array'=>$array,
        ]);
    }
}
