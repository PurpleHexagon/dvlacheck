<?php
declare(strict_types=1);

namespace Cli\Commands;

use Cli\Decorators\CarDetailsMotDateDecorator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use VehicleChecker\Contracts\CarDetailsInterface;
use VehicleChecker\Contracts\VehicleCheckerInterface;
use VehicleChecker\Entities\NullCarDetails;

class VehicleCheckCommand extends Command
{
    /**
     * @param VehicleCheckerInterface $vehicleChecker
     */
    public function __construct(protected VehicleCheckerInterface $vehicleChecker)
    {
        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        $this->addArgument('registration', InputArgument::REQUIRED, 'Vehicle Registration');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $registration = $input->getArgument('registration');

        $output->writeln("<info>🚦 Searching for MOT Details using registration $registration 🚦</info>");
        $output->writeln("<info></info>");

        $output->writeln('');

        $carDetails = $this->vehicleChecker->vehicleDetails($registration);

        if ($carDetails instanceof NullCarDetails) {
            $output->writeln('<error>Car Details Not Found!</error>');
            return self::FAILURE;
        }

        if ($carDetails instanceof CarDetailsInterface) {
            $decoratedCarDetails = new CarDetailsMotDateDecorator($carDetails);
            $output->writeln('<info>Car Details: </info>');

            $output->writeln('');
            $output->writeln("<info>Make:</info> {$carDetails->getMake()}");
            $output->writeln("<info>Model:</info> {$carDetails->getModel()}");
            $output->writeln("<info>Colour:</info> {$carDetails->getColour()}");
            $output->writeln("<info>MOT Expiry:</info> {$decoratedCarDetails->getMotExpiryDetails()}");
            $output->writeln("<info>Times Failed MOT:</info> {$carDetails->getFailedMotCount()}");
            $output->writeln('');
        }

        return self::SUCCESS;
    }
}
