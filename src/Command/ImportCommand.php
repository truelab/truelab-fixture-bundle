<?php

namespace Truelab\Bundle\FixtureBundle\Command;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Truelab\Bundle\FixtureBundle\Entity\EntityManager;
use Truelab\Bundle\FixtureBundle\Fixture\Manager\FixtureManager;
use Truelab\Bundle\FixtureBundle\Process\ImportFixtureProcess;

class ImportCommand extends ContainerAwareCommand

{
    protected function configure()
    {
        $this
            ->setName('truelab:fixture:import')
            ->setDescription('Import fixture to database')
            ->addOption('format', 'f', InputOption::VALUE_OPTIONAL, 'Format for import', 'yaml')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $format = $input->getOption('format');
        // @TODO change manager for different formats
        $classNames = $this->getContainer()->getParameter('truelab_fixture.classes');
        /** @var ImportFixtureProcess $importProcess */
        $importProcess = $this->getContainer()->get('truelab_fixture.importProcess');
        $importProcess->setOutput($output);
        $importProcess->execute($classNames);
    }
}