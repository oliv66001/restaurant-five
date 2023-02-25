<?php

namespace App\Controller;

use App\Entity\Dishes;
use App\Repository\DishesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteController extends AbstractController
{
    /**
     * @Route("/carte", name="app_carte")
     */
    public function index(DishesRepository $dishesRepository): Response
    {
        $dishes = $dishesRepository->findAll();

        return $this->render('carte/index.html.twig', [
            'dishes' => $dishes,
        ]);
    }
}
