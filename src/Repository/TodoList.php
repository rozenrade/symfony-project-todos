<?php 

namespace App\Repository;

use App\Entity\Todo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TodoList extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine, Todo::class);
    }

    public function saveTodo(Todo $newTodo, ?bool $isSaved){

        $this->getEntityManager()->persist($newTodo);
        if($isSaved){

            $this->getEntityManager()->flush();
        }
        return $newTodo;
    }
}