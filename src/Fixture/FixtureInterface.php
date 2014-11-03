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
     * @param $name
     *
     * @return null|mixed
     */
    public function getProperty($name);

    /**
     * @return array
     */
    public function getProperties();

    /**
     * @param string $shortName
     */
    public function setShortName($shortName);

    /**
     * @return string
     */
    public function getShortName();

    /**
     * @param string $className
     */
    public function setClassName($className);

    /**
     * @return string
     */
    public function getClassName();

    /**
     * @param string $id
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getId();
}