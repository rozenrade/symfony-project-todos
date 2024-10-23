<?php 

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine, Task::class);
    }

    public function saveTask(Task $newTask, ?bool $isSaved){

        $this->getEntityManager()->persist($newTask);
        if($isSaved){

            $this->getEntityManager()->flush();
        }
        return $newTask;
    }
}