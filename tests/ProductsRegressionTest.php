<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductsRegressionTest extends WebTestCase
{
    public function testPriceRegression(): void
    {
        // Créez une instance de votre entité Products avec un prix spécifique
        $product = new \App\Entity\Products();
        $product->setPrix(1000); // Par exemple, un prix de 1000 francs guinéens

        // Vérifiez si le prix est correctement défini
        $this->assertSame(1000, $product->getPrix());

        // Vous pouvez ajouter d'autres assertions pour vérifier d'autres comportements liés au prix ici

        // Vous pouvez également effectuer des requêtes HTTP vers votre application pour tester l'affichage du prix sur les pages
        // Assurez-vous d'utiliser la méthode de création de client Symfony pour tester les requêtes HTTP.

        // Exemple de requête HTTP avec le client Symfony
        $client = static::createClient();
        $crawler = $client->request('GET', '/votre-page-de-test');

        // Vérifiez l'affichage du prix dans la réponse HTTP
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('.prix', '1000 FG'); // Assurez-vous d'adapter les sélecteurs CSS en fonction de votre structure HTML
    }
}
