<?php

namespace Truelab\Bundle\FixtureBundle\Parser;

use Truelab\Bundle\FixtureBundle\Fixture\Pack\FixturePackInterface;

interface ParserInterface
{
    /**
     * @param $data
     *
     * @return FixturePackInterface
     */
    public function decode($data);

    /**
     * @param FixturePackInterface $fixturePack
     *
     * @return mixed
     */
    public function encode(FixturePackInterface $fixturePack);
}