<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Dishes;
use App\Repository\DishesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteController extends AbstractController
{
    public function list(Categories $category, DishesRepository $dishesRepository, Request $request): Response
    {


        $page = $request->query->getInt('page', 1);
        $dishes = $dishesRepository->findDishesPaginated($page, $category->getSlug(), 3);

        return $this->render('carte/index.html.twig', [
            'category' => $category,
            'dishes' => $dishes,
        ]);
        
    }
}
