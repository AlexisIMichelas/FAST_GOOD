<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class YourRecipesController extends AbstractController
{
    #[Route('/your/recipes', name: 'app_your_recipes')]
    public function index(): Response
    {
        return $this->render('your_recipes/index.html.twig', [
            'controller_name' => 'YourRecipesController',
        ]);
    }
}
