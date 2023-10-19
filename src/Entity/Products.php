<?php

namespace App\Entity;

use App\Entity\Images;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductsRepository::class)]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le nom du produit ne peut pas être vide')]
    #[Assert\Length(
        min: 5,
        max: 200,
        minMessage: 'Le nom doit faire au moins 5 caractères',
        maxMessage: 'Le nom ne doit pas dépasser plus de 200 caractères'
    )]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z0-9\s\-_]+$/',
        message: 'Le nom du produit ne peut contenir que des lettres, des chiffres, des espaces, des tirets et des underscores.'
    )]
    private ?string $product_name = null;

    #[ORM\Column]
    private ?\DateTime $product_created_at = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Categories $category = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?Admin $admin = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $product_description = null;

    #[ORM\OneToMany(targetEntity: Images::class, mappedBy: 'products', orphanRemoval: true, cascade: ["persist"])]
    private $images;
    
    #[ORM\Column(type:"integer")]
    private $prix;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getProductName(): ?string
    {
        return $this->product_name;
    }
    
    public function setProductName(string $product_name): static
    {
        $this->product_name = $product_name;
        
        return $this;
    }
    
    public function getProductCreatedAt(): ?\DateTime
    {
        return $this->product_created_at;
    }
    
    public function setProductCreatedAt(\DateTime $product_created_at): static
    {
        $this->product_created_at = $product_created_at;
        
        return $this;
    }
    
    public function getCategory(): ?Categories
    {
        return $this->category;
    }
    
    public function setCategory(?Categories $category): static
    {
        $this->category = $category;
        
        return $this;
    }
    
    public function getAdminId(): ?Admin
    {
        return $this->admin;
    }
    
    public function setAdminId(?Admin $admin): static
    {
        $this->admin = $admin;
        
        return $this;
    }
    
    public function getProductDescription(): ?string
    {
        return $this->product_description;
    }
    
    public function setProductDescription(string $product_description): static
    {
        $this->product_description = $product_description;
        
        return $this;
    }
 
    public function __construct()
    {
        $this->images = new ArrayCollection();
    }
    
    public function getImages(): Collection
    {
        return $this->images;
    }
    
    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setProducts($this);
        }
        
        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->removeElement($image)) {
            if ($image->getProducts() === $this) {
                $image->setProducts(null);
            }
        }

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

}
