<?php

// namespace App\Entity;

// use App\Repository\LivreRepository;
// use Doctrine\ORM\Mapping as ORM;

// #[ORM\Entity(repositoryClass: LivreRepository::class)]

// class Livre{
    
//     #[ORM\Id]
//     #[ORM\GeneratedValue(strategy: "AUTO")]
//     #[ORM\Column]
//     private ?int $id = null;
    
//     #[ORM\Column(length: 255)]
//     private ?string $titre = null;
    
//     #[ORM\ManyToOne(targetEntity: Auteur::class, inversedBy: "livres")]
//     private $auteur;
//     /**
//      * Get the value of auteur
//      */ 
//     public function getAuteur(): ?Auteur
//     {
//         return $this->auteur;
//     }
    
//     /**
//      * Set the value of auteur
//      *
//      * @return  self
//      */ 
//     public function setAuteur($auteur): self
//     {
//         $this->auteur = $auteur;
    
//         return $this;
//     }
    
//     public function getId(): ?int
//     {
//         return $this->id;
//     }

//     public function getTitre(): ?string
//     {
//         return $this->titre;
//     }

//     public function setTitre(string $titre): static
//     {
//         $this->titre = $titre;

//         return $this;
//     }

// }