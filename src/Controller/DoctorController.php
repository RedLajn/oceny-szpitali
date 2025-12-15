<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Entity\Review;
use App\Form\ReviewType;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DoctorController extends AbstractController
{
    #[Route('/doctor/{id}', name: 'app_doctor_show')]
    public function show(
        Doctor $doctor,
        ReviewRepository $reviewRepository,
        Request $request,
        EntityManagerInterface $em
    ): Response
    {
        // Pobierz tylko zatwierdzone recenzje
        $reviews = $reviewRepository->findBy([
            'doctor' => $doctor,
            'isApproved' => true
        ], ['createdAt' => 'DESC']);

        // Oblicz średnią ocenę
        $averageRating = null;
        if (count($reviews) > 0) {
            $sum = array_sum(array_map(fn($r) => $r->getRating(), $reviews));
            $averageRating = round($sum / count($reviews), 1);
        }

        // Formularz dodawania recenzji
        $review = new Review();
        $review->setDoctor($doctor);

        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($review);
            $em->flush();

            $this->addFlash('success', 'Dziękujemy za dodanie recenzji! Zostanie ona opublikowana po zatwierdzeniu przez administratora.');

            return $this->redirectToRoute('app_doctor_show', ['id' => $doctor->getId()]);
        }

        return $this->render('doctor/show.html.twig', [
            'doctor' => $doctor,
            'reviews' => $reviews,
            'averageRating' => $averageRating,
            'form' => $form->createView(),
        ]);
    }
}