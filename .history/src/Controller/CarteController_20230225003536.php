<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Categories;
use App\Repository\CategoriesRepository;
use App\Repository\DishesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class CarteController extends AbstractController
{
    /**
     * @Route("/carte", name="app_carte")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $dishes = $em->getRepository(Dishes::class)->findAll();

        return $this->render('carte/index.html.twig', [
            'dishes' => $dishes,
        ]);
    }
}
//class CarteController extends AbstractController
//{

 //   #[Route('/carte', name: 'app_carte')]
 //   public function carte(DishesRepository $dishesRepository, CategoriesRepository $categoriesRepository): Response
 //   {
//
 //       $dishes = $this->getDoctrine()
 //             ->getRepository(Dishes::class)
 //             ->createQueryBuilder('d')
 //             ->leftJoin('d.categories', 'c')
 //             ->getQuery()
 //             ->getResult();
//
 //       $dishes = $dishesRepository->findAll();
 //       $categories = $categoriesRepository->findBy([], ['categoryOrder' => 'ASC']);
 //       return $this->render('carte/carte.html.twig', compact('dishes', 'categories'));
 //   }






