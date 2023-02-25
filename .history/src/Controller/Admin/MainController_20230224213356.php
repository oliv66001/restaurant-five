<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: 'admin_')]
class MainController extends AbstractController
{
    public function index()
    {
        $this->viewBuilder()->setLayout('admin');
    }
}