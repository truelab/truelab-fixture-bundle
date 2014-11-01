<?php

namespace Truelab\Bundle\FixtureBundle\Process;

use Symfony\Component\Console\Output\Output;
use Truelab\Bundle\FixtureBundle\Fixture\Manager\FixtureManagerInterface;

class ExportFixtureProcess implements FixtureProcessInterface
{
    /** @var FixtureManagerInterface */
    protected $fixtureManager;

    public function __construct(FixtureManagerInterface $fixtureManager)
    {
        $this->fixtureManager = $fixtureManager;
    }

    /** @var Output $output */
    protected $output;
    /**
     *
     */
    public function setOutput($output)
    {
        $this->output = $output;
    }

    /**
     * @param array $classNames
     * @return mixed
     */
    public function execute($classNames)
    {
        try {
            foreach ($classNames as $className) {
                $this->fixtureManager->export($className);

                if ($this->output) {
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