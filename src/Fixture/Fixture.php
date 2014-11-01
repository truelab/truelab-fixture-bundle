<?php

namespace Truelab\Bundle\FixtureBundle\Fixture;

class Fixture implements FixtureInterface
{
    protected $properties;
    protected $shortName;
    protected $className;

    public function __construct()
    {
        $this->properties = array();
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function setProperty($name, $value)
    {
        $this->properties[$name] = $value;
    }

    /**
     * @param $name
     *
     * @return null|mixed
     */
    public function getProperty($name)
    {
        if (isset($this->properties[$name])) {
            return $this->properties[$name];
        }

        return null;
    }

    /**
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }



}