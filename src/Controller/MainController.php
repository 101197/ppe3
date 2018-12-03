<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index()
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function getHome()
    {
        return $this->render('main/home.html.twig', [
            'title'=>'Accueil',
        ]);
    }

    /**
     * @Route("/mentionslegales", name="mentionslegales")
     */
    public function getMentionsLegales()
    {
        return $this->render('main/mentionslegales.html.twig', [
            'title'=>'Mentions légales',
            ]);
    }
}
