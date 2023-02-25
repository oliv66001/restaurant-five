<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Repository\DishesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CarteController extends AbstractController
{
    #[Route('/carte', name: 'carte')]
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function carte(DishesRepository $dishesRepository, Request $request, Categories $categories): Response
    {
        // Utilisez $this->entityManager à la place de $this->getDoctrine()->getManager() 
        // pour obtenir l'instance de l'EntityManager dans votre contrôleur.
        $categories = $this->entityManager->getRepository(Categories::class)->findAll();

        $dishes = $dishesRepository->findDishesPaginatedByCategoryId($page, $categoryId, 3);

    return $this->render('carte/index.html.twig', [
        'category' => $category,
        'dishes' => $dishes,
    ]);
    }


   
}
    
