<?php

namespace Truelab\Bundle\FixtureBundle\Fixture\Pack;

use Truelab\Bundle\FixtureBundle\Fixture\FixtureInterface;

interface FixturePackInterface
{
    /**
     * @param FixtureInterface $fixture
     */
    public function addFixture(FixtureInterface $fixture);

    /**
     * @return FixtureInterface[]
     */
    public function getFixtures();

    /**
     * @param string $className
     */
    public function setClassName($className);

    /**
     * @return string
     */
    public function getClassName();

    /**
     * @param string $shortName
     */
    public function setShortName($shortName);

    /**
     * @return string
     */
    public function getShortName();
}