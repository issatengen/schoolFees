<?php

namespace App\Controller;

use App\Entity\Etudiant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;

final class SupprimerEtudiantController extends AbstractController{
    #[Route('/supprimer/etudiant/{id}', name: 'app_supprimer_etudiant',methods:['POST'])]
    public function index(int $id,ManagerRegistry $doctrine): Response
    {
        $entityManager=$doctrine->getManager();
        $etudiant=$entityManager->getRepository(Etudiant::class)->find($id);
        if(!$etudiant){
            $this->addFlash('success','L\'etudiant na pas été supprimé 😐');
        }
        $entityManager->remove($etudiant);
        $entityManager->flush();
        return $this->redirectToRoute('app_liste_etudiant');

    }
}
