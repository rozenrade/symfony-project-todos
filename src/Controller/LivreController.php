<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivreController extends AbstractController
{
    #[Route('/addLivre', name: 'livre.add', methods: ['POST'])]
    function addLivre(Request $req, LivreRepository $repository)
    {
        $titre = $req->request->get('titre');

        if (!isset($titre) || $titre == '') {
            return $this->json(['error' => 'Titre obligatoire !']);
        }

        $newLivre = new Livre();
        $newLivre->setTitre($titre);
        $savedLivre = $repository->save($newLivre, true);

        return $this->json(['id' => $savedLivre->getId(), 'titre' => $savedLivre->getTitre()]);
    }

    #[Route('/showlivres', name: 'livre.all', methods: ['GET'])]
    function getLivre(LivreRepository $repository)
    {

        $livres = $repository->findAll();

        $livreTable = [];
        foreach ($livres as $livre) {
            $livreTable[] = ['id' => $livre->getId(), 'titre' => $livre->getTitre()];
        }
        return $this->json($livreTable);
    }

    #[Route('/livre/{id}', name: 'livre.id', methods: ['GET'])]
    function getLivreById(LivreRepository $repository, int $id)
    {

        $livre = $repository->find($id);

        if (!$livre) {
            return $this->json("Le livre n'existe pas", Response::HTTP_NOT_FOUND);
        }

        return $this->json(['id' => $livre->getId(), 'titre' => $livre->getTitre()]);
    }

    #[Route("/livre/{id}", name: 'livre.update', methods: ['POST'])]
    function updateLivre($id, LivreRepository $repo, Request $req)
    {

        //récupérer le livre
        $livre = $repo->find($id);

        //If not exist
        if (!$livre) {
            return $this->json("Livre n'existe pas", Response::HTTP_NOT_FOUND);
        }

        // Définition du titre
        $newTitre = $req->request->get('titre');

        //  Valider le nouveau titre
        if(!isset($newTitre) || $newTitre = ""){
            return $this->json('Titre obligatoire', Response::HTTP_BAD_REQUEST);
        }
        
        //  Mettre à jour le livre
        $livre->setTitre($newTitre);
        //  Sauvegarder le livre dans la BDD avec le titre changé
        $repo->save($livre, true);
    }

    #[Route("/livre/{id}", name: 'livre.delete', methods: ['DELETE'])]
    function deleteLivre($id, LivreRepository $repository){

        $livre = $repository->find($id);

        if (!$livre){
            return $this->json("Le livre n'existe pas", Response::HTTP_NOT_FOUND);
        }

        $repository->delete($livre);

        return $this->json('Livre supprimé');
    }

}
