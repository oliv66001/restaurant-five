<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Dishes;
use App\Repository\DishesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/carte', name: 'app_carte_')]
class CarteController extends AbstractController
{
    #[Route('/{slug}', name: 'carte')]
    public function carte(Categories $category, DishesRepository $dishesRepository, Request $request): Response
    {


        $page = $request->query->getInt('page', 1);
        $dishes = $dishesRepository->findDishesPaginated($page, $category->getSlug(), 3);

        return $this->render('carte/index.html.twig', [
            'category' => $category,
            'dishes' => $dishes,
        ]);
        
    }
}
