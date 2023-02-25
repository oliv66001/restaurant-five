<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Repository\DishesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categories', name: 'app_categories_')]
class CategoriesController extends AbstractController
{

    #[Route('/{slug}', name: 'list')]
    public function list(Categories $category, DishesRepository $dishesRepository): Response
    {

        $dishes = $dishesRepository->findDishesPaginated($page, $category->getSlug(), 1);


        return $this->render('categories/list.html.twig', compact('category', 'dishes'));
    }
}
