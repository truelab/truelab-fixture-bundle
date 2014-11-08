<?php

namespace Truelab\Bundle\FixtureBundle\Process;

use Truelab\Bundle\FixtureBundle\Fixture\Manager\FixtureManagerInterface;

/**
 * Interface FixtureProcessInterface
 *
 * @package Truelab\Bundle\FixtureBundle\Process
 */
interface FixtureProcessInterface
{
    /**
     * @param array $classNames
     *
     * @return mixed
     */
    public function execute($classNames);

    /**
     * @param FixtureManagerInterface $fixtureManager
     *
     * @return mixed
     */
    public function addFixtureManager(FixtureManagerInterface $fixtureManager);
}