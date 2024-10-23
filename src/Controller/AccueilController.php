<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route("/", name: "accueil", methods: ["GET", "POST"])]
    function accueil(){
        return new Response("<h1>Salut TOUT LE MONDE</h1>", Response::HTTP_OK);
    }

    #[Route("/inscription", name: "accueil", methods: ['POST'])]
    function inscription(Request $request){
        
        return new Response(
            $request->request->get("email"), 
            Response::HTTP_OK
        );
    }

    #[Route("/connexion", name: "accueil", methods: ['POST'])]
    function connexion(Request $request){
        $nom = $request->request->get("nom");
        $prenom = $request->request->get("prenom");
        $email = $request->request->get("email");
        $motdepasse = $request->request->get("motdepasse");
        if(!isset($nom) || !isset($prenom) || !isset($email) || !isset($motdepasse)){
            return new Response(
                "not OK", 
                Response::HTTP_OK
            );
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return new Response(
                "email not good", 
                Response::HTTP_OK
            );
        }

        if(empty($nom) || empty($prenom)){
            return new Response(
                "name or lastname empty", 
                Response::HTTP_OK
            );
        }

        if(strlen($motdepasse) < 6){
            return new Response(
                "password length 6 or plus", 
                Response::HTTP_OK
            );
        }

        return new Response(
            "OK", 
            Response::HTTP_OK
        );
    }

    #[Route("/profile", name: "accueil", methods: ['GET'])]
    function profil(Request $req){

        // DANS CE CAS ON RECUP LES DONNEES DE L'UTILISATEUR DEPUIS LA DB

        // ON RECUP L'IDENTIFIANT DEPUIS LE QUERY DE L'URL
        $id = $req->query->get('id');
        return $this->json([
            "email" => "mad@mad.com",
            "name" => "Son",
            "identifiant" => $id
        ]);
    }
}