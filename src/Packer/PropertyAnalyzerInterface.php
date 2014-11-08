<?php

namespace Truelab\Bundle\FixtureBundle\Packer;

use Truelab\Bundle\FixtureBundle\Fixture\FixtureInterface;

/**
 * Interface PropertyAnalyzerInterface
 *
 * @package Truelab\Bundle\FixtureBundle\Packer
 */
interface PropertyAnalyzerInterface
{
    /**
     * @param \ReflectionProperty $reflectionProperty
     * @param FixtureInterface    $fixture
     * @param mixed               $entity
     */
    public function fromEntity(\ReflectionProperty $reflectionProperty, FixtureInterface $fixture, $entity);

    /**
     * @param \ReflectionProperty $reflectionProperty
     * @param FixtureInterface    $fixture
     * @param mixed               $entity
     */
    public function fromFixture(\ReflectionProperty $reflectionProperty, FixtureInterface $fixture, $entity);
}