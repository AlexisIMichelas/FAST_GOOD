<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;

class OurRecipesController extends AbstractController
{
    #[Route('/our/recipes', name: 'app_our_recipes')]
    public function index(RecipeRepository $recipeRepository, Security $security): Response
    {
        // Récupérer l'utilisateur connecté (l'administrateur)
        $user = $security->getUser();

        // Si l'utilisateur n'est pas connecté, vous pouvez rediriger vers la page de connexion
        if (!$user) {
            return $this->redirectToRoute('app_connexion');
        }

        // Récupérer toutes les recettes associées à l'administrateur connecté
        $recipes = $recipeRepository->findBy(['author' => $user]);

        return $this->render('our_recipes/index.html.twig', [
            'recipes' => $recipes,
        ]);
    }
}
