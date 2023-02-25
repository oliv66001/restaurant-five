<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Dishes;
use App\Repository\DishesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class CarteController extends AbstractController
{
    #[Route('/carte', name: 'carte')]
    public function index(DishesRepository $dishesRepository, Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $dishes = $dishesRepository->findDishesPaginated($page, 3);

        return $this->render('carte/index.html.twig', [
            'dishes' => $dishes,
        ]);
    }

    

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
    
            // le reste du code
        }
    }
    
