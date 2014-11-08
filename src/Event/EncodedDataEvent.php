<?php

namespace Truelab\Bundle\FixtureBundle\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class EncodedDataEvent
 *
 * @package Truelab\Bundle\FixtureBundle\Event
 */
class EncodedDataEvent extends Event
{
    protected $data;

    /**
     * @param mixed $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }


}