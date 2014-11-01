<?php

namespace Truelab\Bundle\FixtureBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Truelab\Bundle\FixtureBundle\Fixture\Manager\FixtureManager;
use Truelab\Bundle\FixtureBundle\Process\ExportFixtureProcess;
use Truelab\Bundle\FixtureBundle\Process\FixtureProcessInterface;

class ExportCommand extends ContainerAwareCommand

{
    protected function configure()
    {
        $this
            ->setName('truelab:fixture:export')
            ->setDescription('Export database to fixtures')
            ->addOption('format', 'f', InputOption::VALUE_OPTIONAL, 'Format for export', 'yaml')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $format = $input->getOption('format');
        // @TODO change manager for different formats
        /** @var ExportFixtureProcess $exportProcess */
        $exportProcess = $this->getContainer()->get('truelab_fixture.export_process');
        $classNames = $this->getContainer()->getParameter('truelab_fixture.classes');
        $exportProcess->setOutput($output);
        $exportProcess->execute($classNames);
    }
}