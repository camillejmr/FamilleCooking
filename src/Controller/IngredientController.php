<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ingredient", name="ingredient_")
 */
class IngredientController extends AbstractController
{
    /**
     * @Route("/ajouterIngredient", name="ajouter")
     */
    public function createIngredient(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ingredient = new Ingredient();
        $ingredientForm = $this->createForm(IngredientType::class, $ingredient);
        $ingredientForm->handleRequest($request);
        if ($ingredientForm->isSubmitted() && $ingredientForm->isValid()) {
            $entityManager->persist($ingredient);
            $entityManager->flush();
            $this->addFlash('success', 'l\'ingrédient à bien été ajouté.');
return $this->redirectToRoute('ingredient_ajouter');
        }
        return $this->render('ingredient/create.html.twig', [
            'ingredientform' => $ingredientForm->createView(),
        ]);
    }
}
