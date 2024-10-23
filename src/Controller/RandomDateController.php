<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RandomDateController
{
    #[Route("/random", name: "randomNumber", methods: ["GET", "POST"])]
    function random(){
        return new Response("<h1>" . rand(0, 1000) . "</h1>", Response::HTTP_OK);
    }

    #[Route("/datetime", name: "datetime", methods: ["GET", "POST"])]
    function date(){
        date_default_timezone_set('Europe/Paris');
        return new Response("<h1>" . date('l jS \of F Y H:i:s') . "</h1>", Response::HTTP_OK);
    }

    //route dynamique
    #[Route("/add/{a}/{b}", name: "bonjour")]
    function bonjour($a, $b){
        if(!is_numeric($a) ||!is_numeric($b)){
            return new Response("<h1>mettre deux nombres entier</h1>", Response::HTTP_OK);
        }
        $result = $a + $b;
        return new Response("<h1>$a + $b = $result</h1>", Response::HTTP_OK);
    }

    #[Route("/salut/{id<\d+>}", name: "bonjour")]
    function id($id){
        return new Response("<h1>Salut $id</h1>", Response::HTTP_OK);
    }
    
    //route dynamique
    #[Route("/salut/{nom}", name: "bonjour")]
    function salut($nom){
        return new Response("<h1>Hello $nom</h1>", Response::HTTP_OK);
    }
}