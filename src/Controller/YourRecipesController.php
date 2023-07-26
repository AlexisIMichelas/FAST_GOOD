<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class YourRecipesController extends AbstractController
{
    #[Route('/your/recipes', name: 'app_your_recipes')]
    public function index(RecipeRepository $recipeRepository): Response
    {
        // Récupérer toutes les recettes
        $recipes = $recipeRepository->findAll();

        return $this->render('your_recipes/index.html.twig', [
            'recipes' => $recipes,
        ]);
    }
}
