<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Dishes;
use App\Repository\DishesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CarteController extends AbstractController
{
    #[Route('/', name: 'app_carte')]
    public function carte(Categories $category, DishesRepository $dishesRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $dishes = $dishesRepository->findAll();
        $category = $this->getEntityManager()->getRepository(Categories::class)->findAll();
        return $this->render('carte/index.html.twig', [
            'category' => $category,
            'dishes' => $dishes,
        ]);
        
    }
}
