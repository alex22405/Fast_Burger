<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoriesRepository;
use App\Repository\ProductsRepository;

class MenuController extends AbstractController
{
    #[Route('/menu', name: 'app_menu')]
    public function index(CategoriesRepository $categoriesRepository, ProductsRepository $productsRepository): Response
    {
        $menuCategory = $categoriesRepository->findOneBy(['name' => 'Menu']);

        if (!$menuCategory) {
            throw $this->createNotFoundException('Category not found');
        }

        $menuProducts = $productsRepository->findBy(['category' => $menuCategory]);

        return $this->render('menu/menu.html.twig', [
            'menuProducts' => $menuProducts,
        ]);
    }
}
