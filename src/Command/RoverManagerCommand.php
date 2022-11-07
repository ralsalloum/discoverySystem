<?php

namespace App\Command;

use App\Exception\InvalidCommandException;
use App\Exception\InvalidDirectionException;
use App\Interface\Surface;
use App\Interface\VehicleManager;
use App\CommandParser\CommandParser;
use App\RoverManager;
use App\Universe\Coordinate;
use App\Universe\Location;
use App\Universe\Surface\TargetArea;
use App\Vehicle\Rover;
use App\CommandParser\DirectionParser;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

final class RoverManagerCommand extends Command
{
    private Surface $surface;

    private VehicleManager $manager;

    // configure our controlling command
    protected function configure(): void
    {
        $this->setName('control-rovers')
            ->setDescription('Send instructions ...')
            ->setHelp('Control rovers command');
    }

    // Run the specified command
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $helper = $this->getHelper('question');

            // First, get the coordinates of the upper right corner of the target area
            $upperRightCoordinates = $this->getUpperRightCornerCoordinates($helper, $input, $output);

            $surfaceCoordinates = new Coordinate($upperRightCoordinates[0], $upperRightCoordinates[1]);
            $this->surface = new TargetArea($surfaceCoordinates);
            $this->manager = new RoverManager($this->surface);

            // Ask for rovers information
            $this->getRoversInformation($helper, $input, $output);

            $this->manager->runInstructions();

            $locations = $this->manager->getVehiclesLocations();

            foreach ($locations as $location) {
                $output->writeln((string) $location);
            }

            // return 0 to indicate the success of running the command
            return 0;

        } catch(\Exception $e) {
            //$output->writeln('Failure in executing the command. Try again with valid input.');
            $output->writeln($e->getMessage());
            // return 1 to indicate the failure of running the command
            return 1;
        }
    }

    private function getUpperRightCornerCoordinates($helper, $input, $output): array
    {
        $upperRightCoordinates = new Question('Enter the upper right corner coordinates separated by one space (Ex: 5 5): ', '');

        return explode(' ', $helper->ask($input, $output, $upperRightCoordinates));
    }

    /**
     * @throws InvalidDirectionException
     * @throws InvalidCommandException
     */
    private function getRoversInformation($helper, $input, $output)
    {
        $newRover = true;

        while ($newRover) {
            $locationAndDestination = $this->getRoverCoordinatesAndDestination($helper, $input, $output);

            $movingInstructions = $this->getRoverMovingInstructions($helper, $input, $output);

            $location = new Location(new Coordinate($locationAndDestination[0], $locationAndDestination[1]),
                DirectionParser::fromString($locationAndDestination[2]));

            $newRover = new Rover($this->surface, $location, $movingInstructions);

            $this->manager->addVehicle($newRover);

            // Check if user wants to provide more rovers
            $isThereNewRover = new ConfirmationQuestion('Another rover to control? (yes|no) ', false);

            $newRover = $helper->ask($input, $output, $isThereNewRover);
        }
    }

    /**
     * Get moving instructions from user
     *
     * @throws InvalidCommandException
     */
    private function getRoverMovingInstructions($helper, $input, $output): array
    {
        $commandsQuestion = new Question('Enter the rover moving instructions without any spaces (Ex: LRM): ', '');

        $commandString = $helper->ask($input, $output, $commandsQuestion);

        return CommandParser::fromString($commandString);
    }

    // Obtain the rovers' coordinates and directions
    private function getRoverCoordinatesAndDestination($helper, $input, $output): array
    {
        $roverQuestion = new Question("Enter the rovers' coordinates and direction separated by single space (Ex: 1 2 N): ",
            "");

        return explode(' ', $helper->ask($input, $output, $roverQuestion));
    }
}
