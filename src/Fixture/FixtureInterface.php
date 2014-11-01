<?php

namespace Truelab\Bundle\FixtureBundle\Fixture;

interface FixtureInterface
{

    /**
     * @param string $name
     * @param mixed $value
     */
    public function setProperty($name, $value);

    /**
     * @return array
     */
    public function getProperties();

    /**
     * @param $name
     */
    public function getProperty($name);
}