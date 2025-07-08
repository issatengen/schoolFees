<?php

namespace App\Controller;

use App\Entity\Specialite;
use App\Form\SpecialiteType;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;

final class SpecialiteController extends AbstractController{
    #[Route('/specialite', name: 'app_specialite')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $form=$this->createForm(SpecialiteType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $specialite=$form->getData();

            $entityManager=$doctrine->getManager();
            $entityManager->persist($specialite);
            $entityManager->flush();
            $this->addFlash('success','Spécialité enregistrée avec succès');
            return $this->redirectToRoute('app_liste_specialites');
        }
        return $this->render('specialite/index.html.twig', [
            'form_specialite' => $form,
        ]);
    }
    // Route for display
    #[Route('/liste_specialite', name: 'app_liste_specialites')]
    public function listeSpecialite(Request $request, ManagerRegistry $doctrine): Response
    {
        $repository=$doctrine->getRepository(Specialite::class);
        $specialites=$repository->findBy([],['code_specialite'=>'ASC']);
        return $this->render('liste_specialite/index.html.twig', [
            'specialites' => $specialites,
        ]);
    }

    // Route for delete
    #[Route('/supprimer_specialite/{id}', name: 'app_supprimer_specialite',methods: ['POST'])]
    public function supprimerSpecialite(int $id,ManagerRegistry $doctrine): Response
    {
        $entityManager=$doctrine->getManager();
        $specialite=$entityManager->getRepository(Specialite::class)->find($id);
        if (!$specialite){
            $this->addFlash('error','La spécialité na pas été supprimée !! 😑😑');
        }
        $entityManager->remove($specialite);
        $entityManager->flush();
        $this->addFlash('success','Spécialité supprimée avec succès !! 😐😐');
        return $this->redirectToRoute('app_liste_specialites');
    }
    // Route for editing
    #[Route('/modifier_specialite/{id}', name: 'app_modifier_specialite',methods: ['POST','GET'])]
    public function modifierSpecialite(int $id,Request $request,ManagerRegistry $doctrine): Response
    {
        $entityManager=$doctrine->getManager();
        $specialite=$entityManager->getRepository(Specialite::class)->find($id);

        if (!$specialite){
            $this->createNotFoundException('Aucune information trouvée !! 😑😑');
        }

        $form=$this->createForm(SpecialiteType::class,$specialite);
        $form->handleRequest($request);
        if($form ->isSubmitted() && $form ->isValid()){
            $entityManager->flush();
            $this->addFlash('error','La spécialité a été modifier avec succès !! 😑😑');
            return $this->redirectToRoute('app_liste_specialites');
        }
        return $this->render('modifier_specialite/index.html.twig',[
            'form'=>$form->createView(),
            'specialite'=>$specialite,
        ]);
    }
}
