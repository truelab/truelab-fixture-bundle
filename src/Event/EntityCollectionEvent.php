<?php

namespace Truelab\Bundle\FixtureBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Truelab\Bundle\FixtureBundle\Entity\EntityCollectionInterface;

/**
 * Class EncodedDataEvent
 *
 * @package Truelab\Bundle\FixtureBundle\Event
 */
class EntityCollectionEvent extends Event
{
    /** @var EntityCollectionInterface */
    protected $entityCollection;

    /**
     * @param \Truelab\Bundle\FixtureBundle\Entity\EntityCollectionInterface $entityCollection
     */
    public function setEntityCollection($entityCollection)
    {
        $this->entityCollection = $entityCollection;
    }

    /**
     * @return \Truelab\Bundle\FixtureBundle\Entity\EntityCollectionInterface
     */
    public function getEntityCollection()
    {
        return $this->entityCollection;
    }



}