<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Dishes;
use App\Repository\DishesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteController extends AbstractController
{
  
  #[Route('/carte/{id}', name: 'carte')]
    public function carte(int $id, DishesRepository $dishesRepository, Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $category = $this->getDoctrine()->getRepository(Categories::class)->find($id);
        $dishes = $dishesRepository->findDishesPaginated($page, $category->getId(), 3);

        return $this->render('carte/index.html.twig', [
            'category' => $category,
            'dishes' => $dishes,
        ]);
    }

}

#[Route('/{id}', name: 'carte')]
public function carte(int $id, DishesRepository $dishesRepository, Request $request): Response
{
    $page = $request->query->getInt('page', 1);
    $category = $this->getDoctrine()->getRepository(Categories::class)->find($id);
    $dishes = $dishesRepository->findDishesPaginated($page, $category->getId(), 3);

    return $this->render('carte/index.html.twig', [
        'category' => $category,
        'dishes' => $dishes,
    ]);
}

}
