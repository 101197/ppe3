<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;

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

    /**
     * @Route("/catalogue", name="catalogue")
     */
    public function getCatalogue()
    {
        $produits = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->findAll();

        return $this->render('main/catalogue.html.twig', [
            'title'=>'Catalogue',
            'produits' => $produits,
        ]);
    }

    /**
     * @Route("/produit/{id}", name="produit")
     */
    public function getProduit()
    {
        return $this->render('main/produit.html.twig', [
            'title'=>'Produits',
        ]);
    }
}
