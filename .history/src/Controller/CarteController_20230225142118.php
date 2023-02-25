<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Repository\DishesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CarteController extends AbstractController
{
    #[Route('/carte', name: 'carte')]
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function carte(DishesRepository $dishesRepository, Request $request, Categories $categories, EntityManagerInterface $em): Response
    {
        $categories = $this->entityManager->getRepository(Categories::class)->findAll();

        $dishes = $dishesRepository->findDishesPaginatedByCategoryId($categories->getId(), $request->query->getInt('page', 1), 6);

    return $this->render('carte/index.html.twig', [
        'category' => $categories,
        'dishes' => $dishes,
    ]);
    }
}
    
