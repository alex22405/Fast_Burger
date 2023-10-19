<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

 #[ORM\Entity]
class ProductVariation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;
    
    
    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank(message: "Le parfum ne peut pas être vide.")]
    private $parfum;
    
    #[ORM\Column(type: "integer")]
    #[Assert\Positive(message: "Le grammage doit être un nombre positif.")]
    private $grammage;
    
    #[ORM\Column(type: "integer")]
    #[Assert\Positive(message: "Le prix doit être un nombre positif.")]
    private $prix;
    
    // Getters and setters
}

