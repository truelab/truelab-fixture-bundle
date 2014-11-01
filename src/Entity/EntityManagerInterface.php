<?php

namespace Truelab\Bundle\FixtureBundle\Entity;

interface EntityManagerInterface
{

    /**
     * @param EntityCollection $entityCollection
     * @return mixed
     */
    public function save(EntityCollection $entityCollection);

    /**
     * @return mixed
     */
    public function load($className);
}