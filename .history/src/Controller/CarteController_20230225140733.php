<?php

namespace App\Controller;

use App\Repository\DishesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CarteController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function carte(): Response
    {
        // Utilisez $this->entityManager à la place de $this->getDoctrine()->getManager() 
        // pour obtenir l'instance de l'EntityManager dans votre contrôleur.
        $categories = $this->entityManager->getRepository(Categories::class)->findAll();

       
    }


 #[Route('/carte', name: 'carte')]
    public function index(DishesRepository $dishesRepository, Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $dishes = $dishesRepository->findDishesPaginated($page, 3);

        return $this->render('carte/index.html.twig', [
            'dishes' => $dishes,
        ]);
    }


    
    public function carte(): Response
    {
        // Utilisez $this->entityManager à la place de $this->getDoctrine()->getManager() 
        // pour obtenir l'instance de l'EntityManager dans votre contrôleur.
        $categories = $this->entityManager->getRepository(Categories::class)->findAll();

        // le reste du code
    }
}
    
