<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Repository\CategoriesRepository;
use App\Repository\DishesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteController extends AbstractController
{

    #[Route('/carte', name: 'app_carte')]
    public function carte(DishesRepository $dishesRepository): Response
    {
        $dishes = $dishesRepository->findAll();
        return $this->render('carte/carte.html.twig', compact('dishes'));
       
        
    }
    

}
