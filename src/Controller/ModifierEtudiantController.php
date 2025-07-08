<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Attribute\Route;

final class ModifierEtudiantController extends AbstractController{
    #[Route('/modifier/etudiant/{id}', name: 'app_modifier_etudiant',methods: ['GET','POST'])]
    public function index(Request $request, $id, ManagerRegistry $doctrine): Response
    {
        $entityManager=$doctrine->getManager();
        $etudiant=$entityManager->getRepository(Etudiant::class)->find($id);
        if(!$etudiant){
            $this->createNotFoundException(
                'Aucune information trouvée 😙😙'
            );
        }

         // On passe l'entite existant au formulaire
        $form=$this->createForm(EtudiantType::class,$etudiant);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->flush();
            $this->addFlash('success','Modifier avec succès');
          return  $this->redirectToRoute('app_liste_etudiant');
        }

        return $this->render('modifier_etudiant/index.html.twig', [
            'form'=>$form->createView(),
            'etudiant' => $etudiant,
        ]);
    }
}
