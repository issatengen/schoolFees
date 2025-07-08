<?php

namespace App\Controller;

use App\Form\RoleType;
use Couchbase\Role;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class RoleController extends AbstractController{
    #[Route('/role/new', name: 'app_role')]
    public function index(Request $request,ManagerRegistry $doctrine): Response
    {
        $form=$this->createForm(RoleType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $role=$form->getData();
            $entityManager=$doctrine->getManager();
            $entityManager->persist($role);
            $entityManager->flush();
            $this->addFlash('success','Role enregistré avec succès');
        }
        return $this->render('role/index.html.twig', [
            'form_role' => $form->createView(),
        ]);
    }
    #[Route('/role/list',name: 'app_listeRole')]
    public function listeRole(ManagerRegistry $doctrine): Response
    {
        $repo=$doctrine->getRepository(Role::class);
        $callRoles=$repo->findAll();
        return $this->render('role/listeRole.html.twig',[
            'allRoles'=>$callRoles,
        ]);
    }


    #[Route('/role/delete/{idRole}', name: 'app_DeleteRole')]
    public function supRole(int $idRole,ManagerRegistry $doctrine): Response
    {
        $entityManager=$doctrine-> getManager();
        $role= $entityManager->getRepository(Role::class)->find($idRole);
        if(!$role){
            $this->addFlash('error','Erreur lors de la suppression');
        }else{
            $entityManager->remove($role);
            $entityManager->flush();
            $this->addFlash('success','Role supprimer avec succes');
        }
        return $this->redirectToRoute('app_role');
    }
}
