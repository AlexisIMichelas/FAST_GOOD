<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OurRecipesController extends AbstractController
{
    #[Route('/our/recipes', name: 'app_our_recipes')]
    public function index(): Response
    {
        return $this->render('our_recipes/index.html.twig', [
            'controller_name' => 'OurRecipesController',
        ]);
    }
}
