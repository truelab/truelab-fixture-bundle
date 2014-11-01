<?php

namespace Truelab\Bundle\FixtureBundle\Parser;

interface DataManagerInterface
{
    /**
     * @param string $className
     *
     * @return mixed $data
     */
    public function load($className);

    /**
     * @param mixed $data
     *
     * @return mixed
     */
    public function save($data);
}