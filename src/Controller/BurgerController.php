<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoriesRepository;
use App\Repository\ProductsRepository;

class BurgerController extends AbstractController
{
    #[Route('/menu', name: 'app_menu')]
    public function index(CategoriesRepository $categoriesRepository, ProductsRepository $productsRepository): Response
    {
        $burgerCategory = $categoriesRepository->findOneBy(['name' => 'Burger']);

        if (!$burgerCategory) {
            throw $this->createNotFoundException('Category not found');
        }

        $burgerProducts = $productsRepository->findBy(['category' => $burgerCategory]);

        return $this->render('burger/burger.html.twig', [
            'burgerProducts' => $burgerProducts,
        ]);
    }
}
