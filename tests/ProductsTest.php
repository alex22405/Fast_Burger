<?php

use App\Entity\Images;
use App\Entity\Products;
use App\Entity\Categories;
use PHPUnit\Framework\TestCase;

class ProductsTest extends TestCase
{
    public function testGetSetProductName()
    {
        $product = new Products();
        $productName = 'Nom du produit de test';

        $product->setProductName($productName);
        $this->assertEquals($productName, $product->getProductName());
    }

    public function testGetSetProductDescription()
    {
        $product = new Products();
        $productDescription = 'Description du produit de test';

        $product->setProductDescription($productDescription);
        $this->assertEquals($productDescription, $product->getProductDescription());
    }

    public function testGetSetCategory()
    {
        $product = new Products();
        
        // Créer un objet Categories factice
        $category = new Categories();

        $product->setCategory($category);
        $this->assertEquals($category, $product->getCategory());
    }



    public function testImagesCollection()
    {
        $product = new Products();

        $this->assertCount(0, $product->getImages());

        $image1 = new Images();
        $image2 = new Images();

        $product->addImage($image1);
        $product->addImage($image2);

        $this->assertCount(2, $product->getImages());

        $product->removeImage($image1);

        $this->assertCount(1, $product->getImages());
    }
}
