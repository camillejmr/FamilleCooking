<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/recettes", name="recipes")
 */
class RecipeController extends AbstractController
{
    /**
     * @Route("/recettesSalees", name="_listSavoryRecipes")
     */
    public function listSavoryRecipes(): Response
    {
        return $this->render('recipe/listSavoryRecipes.html.twig', [
        ]);
    }

    /**
     * @Route("/recettesSucrees", name="_listSweetRecipes")
     */
    public function listSweetRecipes(RecipeRepository $recipeRepository): Response
    {
        $sweetRecipes = $recipeRepository->findAll();
        return $this->render('recipe/listSweetRecipes.html.twig', [
            "sweetRecipes" => $sweetRecipes]);
    }

    /**
     * @Route("/details{id}", name="_details")
     */
    public function details(int $id): Response
    {
        return $this->render('recipe/details.html.twig', [
        ]);
    }

    /**
     * @Route("/ajouterRecette", name="_add")
     */
    public function addRecipe(Request $request, EntityManagerInterface $entityManager): Response
    {
//Création d'une nouvelle instance recipe
        $recipe = new Recipe();
//        Création d'un form recipeType
        $recipeForm = $this->createForm(RecipeType::class, $recipe);

//        Traitement du form: la ligne suivante permet d'hydrater la variable $recipe avec les données récupérées dans le form
        $recipeForm->handleRequest($request);

        if ($recipeForm->isSubmitted() && $recipeForm->isValid()) {
            $entityManager->persist($recipe);
            $entityManager->flush();
            $this->addFlash('success', 'La recette a bien été ajoutée.');
            return $this->redirectToRoute('recipes_details',['id'=>$recipe->getId()]);
        }
//        Envoi du form à la vue twig
        return $this->render('recipe/addRecipe.html.twig', ['recipeform' => $recipeForm->createView()
        ]);
    }
}
