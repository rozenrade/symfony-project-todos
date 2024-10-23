<?php 

// TP: 
// Créer un CRUD pour des auteurs:
// Créer un Entité Auteur avec
// id
// nom
// prénom
// date (année de naissance)

 
// Créer un Repository avec les méthodes pour enregistrer les auteurs

// Faire une migrations pour créer la nouvelle table

// Créer un Controller avec les action:
// Créer un auteur
// Récupérer tous les auteurs
// Récupérer un auteur avec son identifiant
// Récupérer un auteur avec son nom
// Mettre a jour un auteur (nom, prénom ou date)
// Supprimer un auteur.

// namespace App\Entity;

// use App\Repository\LivreRepository;
// use Doctrine\Common\Collections\ArrayCollection;
// use Doctrine\Common\Collections\Collection;
// use Doctrine\ORM\Mapping as ORM;

// #[ORM\Entity(repositoryClass: LivreRepository::class)]

// class Auteur{

//     #[ORM\Id]
//     #[ORM\GeneratedValue(strategy: "AUTO")]
//     #[ORM\Column]
//     private ?int $id = null;

//     #[ORM\Column(length: 255)]
//     private ?string $nom = null;

//     #[ORM\Column(length: 255)]
//     private ?string $prenom = null;

//     #[ORM\Column(length:255)]
//     private ?int $year_of_birth = null;

//     #[ORM\OneToMany(
//         targetEntity: "App\Entity\Livre",
//         mappedBy: "auteur",
//         cascade: ['persist', "remove"]
//     )]

//     private $livres;

//     function __construct()
//     {
//         $this->livres = new ArrayCollection();
//     }
    
//     /**
//      * Get the value of livres
//      */ 
//     public function getLivres(): Collection
//     {
//         return $this->livres;
//     }
    
//     public function addLivre(Livre $livre): Collection
//     {
//         $livre->setAuteur($this);
//         $this->livres->add($livre);
//         return $this->livres;
//     }

//     public function getId(): ?int
//     {
//         return $this->id;
//     }

//     public function getNom(): ?string
//     {
//         return $this->nom;
//     }

//     public function setNom($nom): static
//     {
//         $this->nom = $nom;

//         return $this;
//     }
    
//     public function getPrenom(): ?string
//     {
//         return $this->prenom;
//     }
    
//     public function setPrenom($prenom): static
//     {
//         $this->prenom = $prenom;

//         return $this;
//     }
    
//     public function getYear(): ?string
//     {
//         return $this->year_of_birth;
//     }

//     public function setYear($year_of_birth): static
//     {
//         $this->year_of_birth = $year_of_birth;

//         return $this;
//     }



// }