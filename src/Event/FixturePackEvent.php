<?php

namespace Truelab\Bundle\FixtureBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Truelab\Bundle\FixtureBundle\Fixture\Pack\FixturePackInterface;

/**
 * Class EncodedDataEvent
 *
 * @package Truelab\Bundle\FixtureBundle\Event
 */
class FixturePackEvent extends Event
{
    /** @var FixturePackInterface */
    protected $fixturePackEvent;

    /**
     * @param \Truelab\Bundle\FixtureBundle\Fixture\Pack\FixturePackInterface $fixturePackEvent
     */
    public function setFixturePackEvent($fixturePackEvent)
    {
        $this->fixturePackEvent = $fixturePackEvent;
    }

    /**
     * @return \Truelab\Bundle\FixtureBundle\Fixture\Pack\FixturePackInterface
     */
    public function getFixturePackEvent()
    {
        return $this->fixturePackEvent;
    }



}