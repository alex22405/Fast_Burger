<?php

namespace App\Controller\Admin;

use App\Entity\Images;
use App\Entity\Products;
use App\Form\ProductsFormType;
use App\Service\PictureService;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/admin/products')]
class ProductsController extends AbstractController
{

    #[Route('/products/{id}', name: 'products_details')]
    public function showProductDetails($id, ProductsRepository $productsRepository): Response
    {
        $product = $productsRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Product not found');
        }

        return $this->render('admin/products/details.html.twig', [
            'products' => $product,
        ]);
    }

    #[Route('/', name: 'admin_products_index', methods: ['GET'])]
    public function index(ProductsRepository $productsRepository): Response
    {
        $products = $productsRepository->findAll();

        return $this->render('admin/products/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/add', name: 'admin_products_add')]
    public function add(Request $request, EntityManagerInterface $entityManager, PictureService $pictureService): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // On crée un nouveau produit
        $product = new Products();

        // Remplir les autres propriétés du produit
        $product->setProductCreatedAt(new \DateTime());

        // On crée le formulaiire
        $form = $this->createForm(ProductsFormType::class, $product);

        // On traite la requête du formulaire
        $form->handleRequest($request);

        // On vérifie si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {

            // On récupère les images
            $images = $form->get('images')->getData();

            foreach($images as $image){
                // On définit le dossier de destination
                $folder = 'products';

                // On appelle le service d'ajout
                $fichier = $pictureService->add($image, $folder, 300, 300);

                $img = new Images();
                $img->setName($fichier);
                $product->addImage($img);
            }

            //On stocke
            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash('success', 'Produit ajouté avec succès');

            // On redirige
            return $this->redirectToRoute('admin_products_index');
        }

        return $this->render('admin/products/add.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit/{id}', name: 'admin_products_edit')]
    public function edit(Request $request, Products $product, EntityManagerInterface $entityManager, PictureService $pictureService): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // On crée le formulaire
        $form = $this->createForm(ProductsFormType::class, $product);

        // On traite la requête du formulaire
        $form->handleRequest($request);

        // On vérifie si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {

            // On récupère les images
            $images = $form->get('images')->getData();

            foreach($images as $image) {
                // On définit le dossier de destination
                $folder = 'products';

                // On appelle le service d'ajout
                $fichier = $pictureService->add($image, $folder, 300, 300);

                $img = new Images();
                $img->setName($fichier);
                $product->addImage($img);
            }

            //On stocke
            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash('success', 'Produit modifié avec succès');

            // On redirige
            return $this->redirectToRoute('admin_products_index');

        }
        
        return $this->render('admin/products/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete/{id}', name: 'admin_products_delete')]
    public function delete(Products $product, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', $product);

        // Supprimer le produit de la base de données
        $entityManager->remove($product);
        $entityManager->flush();

         // Enregistrer un message flash pour confirmer la suppression
        $this->addFlash('success', 'Le produit a été supprimé avec succès.');

        return $this->redirectToRoute('admin_products_index');
    }


    #[Route('/delete/image/{id}', name: 'admin_products_delete_image', methods: ['DELETE'])]
    public function deleteImage(Images $image, Request $request, EntityManagerInterface $em, PictureService $pictureService): JsonResponse
    {
        // On récupère le contenu de la requête
        $data = json_decode($request->getContent(), true);

        if($this->isCsrfTokenValid('delete' . $image->getId(), $data['_token'])){
            // Le token csrf est valide
            // On récupère le nom de l'image
            $nom = $image->getName();

            if($pictureService->delete($nom, 'products', 300, 300)){
                // On supprime l'image de la base de données
                $em->remove($image);
                $em->flush();

                return new JsonResponse(['success' => true], 200);
            }
            // La suppression a échoué
            return new JsonResponse(['error' => 'Erreur de suppression'], 400);
        }

        return new JsonResponse(['error' => 'Token invalide'], 400);
    }
}
