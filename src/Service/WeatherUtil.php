<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Location;
use App\Entity\Measurment;
use App\Repository\LocationRepository;
use App\Repository\MeasurmentRepository;


class WeatherUtil
{
    public function __construct(
        private MeasurmentRepository $measurementRepository,
        private LocationRepository $locationRepository,
    ) {
    }
    /**
     * @return Measurment[]
     */
    public function getWeatherForLocation(Location $location): array
    {
        return $this->measurementRepository->findByLocation($location);
    }

    /**
     * @return Measurment[]
     */
    public function getWeatherForCountryAndCity(string $countryCode, string $city): array
    {
        {
            $location = $this->locationRepository->findOneBy([
                'country' => $countryCode,
                'city' => $city,
            ]);

            if (!$location) {
                return [];
            }

            return $this->getWeatherForLocation($location);
        }
    }
}
