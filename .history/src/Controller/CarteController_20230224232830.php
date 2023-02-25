<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Repository\CategoriesRepository;
use App\Repository\DishesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteController extends AbstractController
{

    #[Route('/carte', name: 'app_carte')]
    public function carte(DishesRepository $dishesRepository, CategoriesRepository $categoriesRepository): Response
    {
        $dishes = $dishesRepository->findAll();
        $categories = $categoriesRepository->findBy([], ['categoryOrder' => 'ASC']);
        return $this->render('carte/carte.html.twig', compact('dishes', 'categories'));
    }
}
