<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Repository\EtudiantRepository;
use App\Entity\Payment;
use App\Repository\PaymentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

final class ShowPaymentController extends AbstractController
{
    #[Route('/show/payment/{id}', name: 'app_show_payment', methods: ['GET'])]
    public function index($id, EntityManagerInterface $entityManager): Response
    {
        $student= $entityManager->getRepository(Etudiant::class)->find($id);
        if (!$student) {
            throw $this->createNotFoundException('Student not found');
        }
        $payments= $entityManager->getRepository(Payment::class)->findBy(['student' => $student]);
        return $this->render('show_payment/index.html.twig', [
            'payments' => $payments,
            'etudiant' => $student,
        ]);
    }
}
