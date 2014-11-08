<?php

namespace Truelab\Bundle\FixtureBundle\Process;

use Symfony\Component\Console\Output\OutputInterface;
use Truelab\Bundle\FixtureBundle\Fixture\Manager\FixtureManagerInterface;

/**
 * Class ExportFixtureProcess
 *
 * @package Truelab\Bundle\FixtureBundle\Process
 */
class ExportFixtureProcess implements FixtureProcessInterface
{
    /** @var FixtureManagerInterface[] */
    protected $fixtureManagers;

    /** @var OutputInterface $output */
    protected $output;

    /**
     * __construct
     */
    public function __construct()
    {
        $this->fixtureManagers = array();
    }

    /**
     * @param FixtureManagerInterface $fixtureManager
     *
     * @return mixed|void
     */
    public function addFixtureManager(FixtureManagerInterface $fixtureManager)
    {
        $this->fixtureManagers[] = $fixtureManager;
    }

    /**
     * @param OutputInterface $output
     */
    public function setOutput(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * @param array $classNames
     *
     * @return mixed
     */
    public function execute($classNames)
    {
        try {
            foreach ($this->fixtureManagers as $fixtureManager) {
                foreach ($classNames as $className) {
                    $fixtureManager->export($className);
                    $this->output->writeln('[EXPORT] ' .$className);
                }
            }
        } catch (\Exception $e) {
            if ($this->output) {
                $this->output->writeln($e->getMessage());
            }
        }
    }
}