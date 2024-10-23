<?php 

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskRepository::class)]

class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: "boolean")]
    private $isFinished = false;

    #[ORM\ManyToOne(targetEntity: Todo::class, inversedBy: "tasks")]
    private $todo;
    
    /**
     * Get the value of todo
     */ 
    public function getTodo(): ?Todo
    {
        return $this->todo;
    }
    
    /**
     * Set the value of todo
     *
     * @return  self
     */ 
    public function setTodo($todo): self
    {
        $this->todo = $todo;
    
        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function isFinished(): bool
    {
        return $this->isFinished;
    }

    public function setIsFinished(bool $isFinished): self
    {
        $this->isFinished = $isFinished;

        return $this;
    }   
}