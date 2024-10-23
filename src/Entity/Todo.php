<?php

namespace App\Entity;

use App\Repository\TodoList;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TodoList::class)]

class Todo
{

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: "datetime")]
    private ?DateTime $date = null;

    #[ORM\OneToMany(
        targetEntity: 'App\Entity\Task',
        mappedBy:"todo", 
        cascade: ['persist', "remove"]
        )]
    // Collection de tâches
    private $tasks; 

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }

    public function getTask(): ?string
    {
        return $this->tasks;
    }

    public function setTask(string $task): self
    {
        $this->tasks = $task;

        return $this;
    }

    // Ajouter une tâche depuis une collection
    public function addTask(Task $task ): Collection
    {
        $task->setTodo($this);

        $this->tasks->add($task);

        return $this->$task;

    }
    
    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */

    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of name
     */

    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */

    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

}
