<?php

namespace App\Repository;

use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine, Livre::class);
    }

    public function save(Livre $newLivre, ?bool $isSave)
    {

        $this->getEntityManager()->persist($newLivre);

        if ($isSave) {
            $this->getEntityManager()->flush();
        }
        return $newLivre;
    }

    function delete(Livre $livre){
        $this->getEntityManager()->remove($livre);
        $this->getEntityManager()->flush();
    }
}
