<?php

namespace Truelab\Bundle\FixtureBundle\Packer;

use Truelab\Bundle\FixtureBundle\Entity\EntityCollection;
use Truelab\Bundle\FixtureBundle\Fixture\FixtureInterface;
use Truelab\Bundle\FixtureBundle\Fixture\Pack\FixturePackInterface;

interface PropertyAnalyzerInterface
{
    public function fromEntity(\ReflectionProperty $reflectionProperty, FixtureInterface $fixture, $entity);

    public function fromFixture(\ReflectionProperty $reflectionProperty, FixtureInterface $fixture, $entity);
}