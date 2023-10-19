<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class Conditions extends AbstractController
{
    public function mentionsLegales(): Response
    {
        return $this->render('conditions/mentions_legales.html.twig');
    }

    public function politiqueConfidentialite(): Response
    {
        return $this->render('conditions/politique_confidentialite.html.twig');
    }

    public function Cgv(): Response
    {
        return $this->render('conditions/cgv.html.twig');
    }
}
