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
    #[Route('/', name: 'carte')]
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function carte(DishesRepository $dishesRepository, Request $request, Categories $categories, EntityManagerInterface $em): Response
    {
        // Utilisez $this->entityManager à la place de $this->getDoctrine()->getManager() 
        // pour obtenir l'instance de l'EntityManager dans votre contrôleur.
        $categories = $this->entityManager->getRepository(Categories::class)->findAll();

        $dishes = $dishesRepository->findDishesPaginatedByCategoryId($categories->getId(), $request->query->getInt('page', 1), 6);

    return $this->render('carte/index.html.twig', [
        'category' => $categories,
        'dishes' => $dishes,
    ]);
    }
}
    
