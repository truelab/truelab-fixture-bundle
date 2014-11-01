<?php

namespace Truelab\Bundle\FixtureBundle\Fixture\Manager;

interface FixtureManagerInterface
{
    public function import($className);
    public function export($className);
}