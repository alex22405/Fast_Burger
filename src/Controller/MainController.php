<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ProductsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(CategoriesRepository $categoriesRepository, ProductsRepository $productsRepository): Response
    {
        $menuCategory = $categoriesRepository->findOneBy(['name' => 'Menu']);

        if (!$menuCategory) {
            throw $this->createNotFoundException('Category not found');
        }

        $menuProducts = $productsRepository->findBy(['category' => $menuCategory]);
        return $this->render('main/index.html.twig', [
            'menuProducts' => $menuProducts,
        ]);
    }
}
