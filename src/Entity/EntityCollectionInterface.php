<?php

namespace Truelab\Bundle\FixtureBundle\Entity;

interface EntityCollectionInterface
{
    /**
     * @param array $entities
     */
    public function setEntities($entities);

    /**
     * @return array
     */
    public function getEntities();
}