<?php 

namespace App\Repository;

use App\Entity\Auteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AuteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $doctrine)
    {

        parent::__construct($doctrine, Auteur::class);
    }

    public function saveAuteur(Auteur $auteur, ?bool $isSaved)
    {

        $this->getEntityManager()->persist($auteur);

        if($isSaved){
            $this->getEntityManager()->flush();
        }
        return $auteur;
    }
}