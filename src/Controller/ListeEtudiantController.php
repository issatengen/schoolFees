<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;
// importer l'entite Etudiant
use App\Entity\Etudiant;
use App\Form\EtudiantType;

final class ListeEtudiantController extends AbstractController{
    #[Route('/etudiants', name: 'app_liste_etudiant')]
    public function index(Request $request,ManagerRegistry $doctrine): Response
    {
        $repository=$doctrine->getRepository(Etudiant::class);
        $etudiants=$repository->findBy([],['nom_etudiant'=>'ASC','prenom_etudiant'=>'ASC']);
        return $this->render('liste_etudiant/index.html.twig', [
            'etudiants' => $etudiants,
        ]);
    }
    #[Route('/etudiants/impayes', name: 'app_liste_etudiant_impayes')]
    public function etudiantsImpayes(Request $request, \Doctrine\ORM\EntityManagerInterface $em): Response
    {
        $conn = $em->getConnection();
        $sql = "
            SELECT e.*, s.*, COALESCE(SUM(p.amount), 0) as total_paye
            FROM etudiant e
            JOIN specialite s ON s.id = e.code_specialite_id
            LEFT JOIN payment p ON e.id = p.student_id
            GROUP BY s.code_specialite
            HAVING total_paye < s.fee
        ";
        $stmt = $conn->prepare($sql);
        $result = $stmt->executeQuery();
        $etudiants = $result->fetchAllAssociative();

        return $this->render('liste_etudiant/impayes.html.twig', [
            'etudiants' => $etudiants,
        ]);
    }
    
}
