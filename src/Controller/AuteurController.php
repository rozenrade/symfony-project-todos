<?php 

namespace App\Controller;

use App\Entity\Auteur;
use App\Entity\Livre;
use App\Repository\AuteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuteurController extends AbstractController
{

    #[Route('/createAuteur', name: 'auteur.add', methods:['POST'])]
    // ADD AUTEUR
    function addAuteur(Request $req, AuteurRepository $auteur){

        $nom = $req->request->get('nom');
        $prenom = $req->request->get('prenom');
        $year_of_birth = $req->request->get('year_of_birth');
        
        if(!isset($nom) || $nom = "") {
            return $this->json(['erreur' => 'Nom Obligatoire! ']);
        }
        if(!isset($prenom) || $prenom = "") {
            return $this->json(['erreur' => 'prenom Obligatoire! ']);
        }
        if(!isset($year_of_birth) || $year_of_birth = "") {
            return $this->json(['erreur' => 'Date de naissance Obligatoire! ']);
        }

        $auteur = new Auteur();

        $auteur->setNom($nom);
        $auteur->setPrenom($prenom);
        $auteur->setYear($year_of_birth);
    }
    // GET ALL 
    #[Route('/getAuteur', name: 'auteur.all', methods:['GET'])]
    function getAuteur(AuteurRepository $repo){

        $auteurs = $repo->findAll();

        $tabAuteur = [];
        foreach ($auteurs as $auteur){
            $tabAuteur[] = ['id' => $auteur->getId(), 'nom' => $auteur->getNom()];
        }
        return $this->json($tabAuteur);
    }
    // GET BY ID
    #[Route('/auteur/{id}', name: 'auteur.id', methods: ['GET'])]
    function getAuteurById(AuteurRepository $repo, int $id)
    { 

        $auteur = $repo->find($id);

        if (!$auteur) {
            return $this->json("L'auteur n'existe pas", Response::HTTP_NOT_FOUND);
        }

        return $this->json(['id' => $auteur->getId(), 'nom' => $auteur->getNom()]);
    }
    // GET BY NAME
    #[Route('/auteur/{id}', name: 'auteur.id', methods: ['GET'])]
    function getAuteurByName(AuteurRepository $repo, int $nom)
    {

        $auteur = $repo->find($nom);

        if (!$auteur) {
            return $this->json("L'auteur n'existe pas", Response::HTTP_NOT_FOUND);
        }

        return $this->json(['id' => $auteur->getId(), 'nom' => $auteur->getNom()]);
    }

    #[Route('/auteur/{id}', name: 'auteur.id', methods: ['GET'])]
    function updateAuteur($id, AuteurRepository $repo, Request $req)
    {

        //récupérer le livre
        $auteur = $repo->find($id);

        //If not exist
        if (!$auteur) {
            return $this->json("Livre n'existe pas", Response::HTTP_NOT_FOUND);
        }

        // Définition du titre
        $nom = $req->request->get('nom');
        $prenom = $req->request->get('prenom');
        $year_of_birth = $req->request->get('birthday');

        //  Valider le nouveau titre
        if(!isset($nom) || $nom = ""){
            return $this->json('Nom obligatoire', Response::HTTP_BAD_REQUEST);
        }
        if(!isset($prenom) || $prenom = ""){
            return $this->json('Prenom obligatoire', Response::HTTP_BAD_REQUEST);
        }
        if(!isset($year_of_birth) || $year_of_birth = ""){
            return $this->json('Birthday obligatoire', Response::HTTP_BAD_REQUEST);
        }
        
        //  Mettre à jour le livre
        $auteur->setNom($nom);
        $auteur->setPrenom($prenom);
        $auteur->setYear($year_of_birth);

        //  Sauvegarder l'auteur dans la BDD 
        $repo->save($auteur, true);
    }

    #[Route('/auteur/livre/{auteur_id}', name: "auteur.livre", methods: ["POST"])]
    function addLivre(AuteurRepository $auteurRepo, Request $req, $auteur_id)
    {
        $auteur = $auteurRepo->find($auteur_id);
        if(!$auteur)
        {
            return $this->json('Auteur Introuvable', Response::HTTP_BAD_REQUEST);
        }

        $titre = $req->request->get('titre');
        if(!isset($titre) || $titre == ""){
            return $this->json('Titre Obligatoire', Response::HTTP_BAD_REQUEST);
        } 

        $livre = new Livre();
        $livre->setTitre($titre);

        $auteur->addLivre($livre);

        $auteurRepo->saveAuteur($auteur, true);

        return $this->json(['titre' => $livre->getTitre()]);
    }
} 