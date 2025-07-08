<?php

namespace App\Controller;

// toute objet importé doit être itilisé
use App\Entity\Etudiant;
use App\Form\EtudiantType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;

final class EtudiantController extends AbstractController{
    #[Route('/etudiant', name: 'app_etudiant')]
    // important de declarer une variable request sachant que symfony utilise une architecture request:response
      // Injection des dependances
    public function index(Request $request,ManagerRegistry $doctrine): Response
    {
        $requete='SELECT COUNT(e.id) FROM App\Entity\Etudiant e';
        $NbEtudiant=$doctrine->getManager();
        $query=$NbEtudiant->createQuery($requete);
        $nbreEtudiant=$query->getSingleScalarResult();

        // instanciation du formulaire provenant de src/Form/EtudiantType.php
        $form=$this->createForm(EtudiantType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            // Insertion des éléments dans la base de données
            $etudiant=$form->getData();

            // utilisation de l'objet $doctrine
            $entityManager=$doctrine->getManager();
            $year=date('Y');
            // génération du matricule de l'étudiant
            $matricule='STD'.$year.rand(1,1000);
            $etudiant->setMatriculeEtudiant($matricule);
            $entityManager->persist($etudiant);
            $entityManager->flush();
            $this->addFlash('success','Etudiant ajouté avec succès');

            // redirection après soumission
            return $this->redirectToRoute('app_liste_etudiant');
        }

        return $this->render('etudiant/index.html.twig', [
            'form_etudiant'=>$form->createView(),
            'nbreEtudiant'=>$nbreEtudiant
        ]);
    }
}
