<?php

namespace App\Controller\Admin;

use App\Entity\Dishes;
use App\Entity\Images;
use App\Form\DishesFormType;
use App\Service\PictureService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/dishes', name: 'admin_dishes_')]
class DishesController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('admin/dishes/index.html.twig');
    }

    #[Route('/ajout', name: 'add')]
    public function add(Request $request, EntityManagerInterface $em, SluggerInterface $slugger, PictureService $pictureService): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // Création d'un nouveau plat
        $dishes = new Dishes();

        // Création du formulaire
        $dishesForm = $this->createForm(DishesFormType::class, $dishes);

        $dishesForm->handleRequest($request);

        //Vérification du soumission du formulaire
        if ($dishesForm->isSubmitted() && $dishesForm->isValid()) {

            // Récuperation des images
            $images = $dishesForm->get('images')->getData();

            foreach ($images as $image) {
                $folder = 'dishes';

                // Generate a unique name for the file before saving it
                $fichier = $pictureService->add($image, $folder, 300, 300);

                $img = new Images();
                $img->setName($fichier);
                $dishes->addImage($img);
                // Move the file to the directory where brochures are stored

            }

            $slug = $slugger->slug($dishes->getName());
            $dishes->setSlug($slug);
            $em->persist($dishes);
            $em->flush();


            //Message flash
            $this->addFlash('success', 'Le plat a bien été ajouté');

            //Redirection vers la page de détails du plat
            return $this->redirectToRoute('admin_dishes_index', ['slug' => $dishes->getSlug()]);
        }

        return $this->render('admin/dishes/add.html.twig', compact('dishesForm'));
    }


    #[Route('/edition/{id}', name: 'edit')]
    public function edit(Dishes $dishes, Request $request, EntityManagerInterface $em, SluggerInterface $slugger, PictureService $pictureService): Response
    {
        //Vérification si l'user peut éditer avec le voter
        $this->denyAccessUnlessGranted('DISHES_EDIT', $dishes);

        // Création du formulaire
        $dishesForm = $this->createForm(DishesFormType::class, $dishes);

        $dishesForm->handleRequest($request);

        //Vérification du soumission du formulaire
        if ($dishesForm->isSubmitted() && $dishesForm->isValid()) {

            // Récuperation des images
            $images = $dishesForm->get('images')->getData();

            foreach ($images as $image) {
                $folder = 'dishes';

                // Generate a unique name for the file before saving it
                $fichier = $pictureService->add($image, $folder, 300, 300);

                $img = new Images();
                $img->setName($fichier);
                $dishes->addImage($img);
                // Move the file to the directory where brochures are stored

            }
            $slug = $slugger->slug($dishes->getName());
            $dishes->setSlug($slug);
            $em->persist($dishes);
            $em->flush();


            //Message flash
            $this->addFlash('success', 'Le plat a bien été modifier');

            //Redirection vers la page de détails du plat
            return $this->redirectToRoute('admin_dishes_index', ['slug' => $dishes->getSlug()]);
        }

        return $this->render('admin/dishes/edit.html.twig', [
            'dishesForm' => $dishesForm->createView(),
            'dishes' => $dishes

        ]);
    }

    #[Route('/suppression/{id}', name: 'delete')]
    public function delete(Dishes $dishes): Response
    {
        //Vérification si l'user peut supprimer avec le voter
        $this->denyAccessUnlessGranted('DISHES_DELETE', $dishes);

        return $this->render('admin/dishes/index.html.twig');
    }

    #[Route('/suppression/image/{id}', name: 'delete_image')]
    public function deleteImage(Dishes $dishes): Response
    {
        //Vérification si l'user peut supprimer avec le voter
        $this->denyAccessUnlessGranted('DISHES_DELETE', $dishes);
        
        return $this->render('admin/dishes/index.html.twig');
    }
}
