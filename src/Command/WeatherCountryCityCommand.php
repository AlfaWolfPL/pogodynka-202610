<?php

namespace App\Command;

use App\Repository\LocationRepository;
use App\Service\WeatherUtil;
use Symfony\Component\Console\Attribute\Argument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'weather:country-city',
    description: 'Add a short description for your command',
)]
class WeatherCountryCityCommand{
    public function __construct(
        private LocationRepository $locationRepository,
    ) {
    }
    public function __invoke(
        SymfonyStyle $io,
        #[Argument('Country ID')] string $countryID,
        #[Argument('City Name')] string $city,
    ): int {
        $location = $this->locationRepository->findOneBy([
            'country' => $countryID,
            'city' => $city,
        ]);
        $io->writeln(sprintf('Id is: %s', $location->getId()));
        $io->table(['City', 'Country','Latitude','Longitude'], [[
            $location->getCity(),
            $location->getCountry(),
            $location->getLatitude(),
            $location->getLongitude(),
        ]]);
        return Command::SUCCESS;
    }
}
