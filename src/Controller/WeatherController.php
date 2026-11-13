<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\MeasurmentRepository;

use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class WeatherController extends AbstractController
{
    #[Route('/weather/{city}')]
    public function city(#[MapEntity(expr: 'repository.findOneByCityName(city)')]Location $location, MeasurmentRepository $measurmentRepository): Response
    {
        $measurement = $measurmentRepository->findByLocation($location);
        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'measurements' => $measurement,
            'controller_name' => 'WeatherController',
        ]);
    }
}
