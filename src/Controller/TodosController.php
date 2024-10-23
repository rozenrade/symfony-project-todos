<?php

namespace App\Controller;

use App\Entity\Task;
use App\Entity\Todo;
use App\Repository\TodoList;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodosController extends AbstractController
{
    #[Route('/todos', name: 'todos', methods: ['GET'])]
    function todos()
    {

        return $this->render('todos.html.twig');
    }

    #[Route('/process-todos', name: 'process-todos', methods: ['GET', 'POST'])]
    function processTodos(Request $req, TodoList $repo)
    {

        $name = $req->request->get('todo_list');
        $date = $req->request->get('date');
        $taskName = $req->request->get('task');

        $date = new DateTime();


        if (!isset($name) || empty($name)) {
            //  doit return sur la page de création avec une erreur
            return $this->render('todos.html.twig', ['success' => 'false', 'message' => 'message manquant']);
        }

        // doit ajouter à la bdd et return sur la page avec les liste
        $todo = new Todo();
        $todo->setName($name);
        $todo->setDate($date);

        $task = new Task();
        $task->setName($taskName);

        $savedTodo = $repo->saveTodo($todo, true);
        $savedTask = $repo->saveTask($task, true);

        return $this->render(
            'home.html.twig',
            [
                'success' => 'true',
                'message' => 'successfully imported',
            ]
        );
    }

}
