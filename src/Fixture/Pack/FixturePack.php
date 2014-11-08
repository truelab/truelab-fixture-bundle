<?php

namespace Truelab\Bundle\FixtureBundle\Fixture\Pack;

use Truelab\Bundle\FixtureBundle\Entity\EntityCollection;
use Truelab\Bundle\FixtureBundle\Entity\EntityCollectionInterface;
use Truelab\Bundle\FixtureBundle\Fixture\Fixture;
use Truelab\Bundle\FixtureBundle\Fixture\FixtureInterface;

/**
 * Class FixturePack
 *
 * @package Truelab\Bundle\FixtureBundle\Fixture\Pack
 */
class FixturePack implements FixturePackInterface
{
    protected $fixtures;
    protected $shortName;
    protected $className;

    /**
     * __construct
     */
    public function __construct()
    {
        $this->fixtures = array();
    }

    /**
     * @param FixtureInterface $fixture
     */
    public function addFixture(FixtureInterface $fixture)
    {
        $this->fixtures[] = $fixture;
    }

    /**
     * @return FixtureInterface[]
     */
    public function getFixtures()
    {
        return $this->fixtures;
    }


    /**
     * @param string $className
     */
    public function setClassName($className)
    {

        $this->className = $className;
        $this->shortName = $this->generateShortName($className);
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @param string $shortName
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;
    }

    /**
     * @return string
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * @param string $className
     *
     * @return mixed
     */
    protected function generateShortName($className)
    {
        return str_replace('\\', '_', strtolower($className));
    }
}