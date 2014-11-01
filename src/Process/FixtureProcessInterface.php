<?php

namespace Truelab\Bundle\FixtureBundle\Process;

interface FixtureProcessInterface
{
    /**
     * @param array $classNames
     * @return mixed
     */
    public function execute($classNames);
}