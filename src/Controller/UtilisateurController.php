<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\UtilisateurType;
use App\Entity\Utilisateur;
use Doctrine\Persistence\ManagerRegistry;

final class UtilisateurController extends AbstractController{
    #[Route('/utilisateur', name: 'app_utilisateur')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $requete='SELECT COUNT(u.id) FROM App\Entity\Utilisateur u';
        $nb=$doctrine->getManager();
        $countUser=$nb->createQuery($requete);
        $nbUser=$countUser->getSingleScalarResult();

        $form=$this->createForm(UtilisateurType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $utilisateur=$form->getData();

            $entityManager=$doctrine->getManager();
            $entityManager->persist($utilisateur);
            $entityManager->flush();
            $this->addFlash('success','Utilisateur entregistrer avec succes');
            return $this->redirectToRoute('app_liste_utilisateur');
        }
        return $this->render('utilisateur/index.html.twig', [
            'form_utilisateur' => $form,
            'nbUser'=> $nbUser,
        ]);
    }
}
