<?php

namespace App\Controller;

use App\Entity\Hospital;
use App\Repository\DoctorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HospitalController extends AbstractController
{
    #[Route('/hospital/{id}', name: 'app_hospital_show')]
    public function show(Hospital $hospital, DoctorRepository $doctorRepository): Response
    {
        $doctors = $doctorRepository->findBy(['hospital' => $hospital]);

        return $this->render('hospital/show.html.twig', [
            'hospital' => $hospital,
            'doctors' => $doctors,
        ]);
    }
}