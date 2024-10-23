<?php

namespace App\Controller;

use App\Repository\TodoList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route("/", name: "home", methods: ["GET"])]
    function accueil(TodoList $repository)
    {
        $todos = $repository->findAll();
        $todosTable = [];

        foreach ($todos as $todo) {
            $todosTable[] = [
                'id' => $todo->getId(),
                'name' => $todo->getName(),
                'date' => $todo->getDate()->format('Y-m-d'),
            ];
        }

        return $this->render('home.html.twig', ['todos' => $todosTable]);
    }
}
