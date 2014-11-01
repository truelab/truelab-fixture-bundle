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

class PurgeCommand extends ContainerAwareCommand

{
    protected function configure()
    {
        $this
            ->setName('truelab:fixture:purge')
            ->setDescription('Purge Database')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $purger = $this->getContainer()->get('truelab_fixture.purger');
        $purger->purge();
        $output->writeln('Purge success');
    }
}