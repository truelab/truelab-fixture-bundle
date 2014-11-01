<?php

namespace Truelab\Bundle\FixtureBundle\Packer;

use Truelab\Bundle\FixtureBundle\Entity\EntityCollection;
use Truelab\Bundle\FixtureBundle\Fixture\Pack\FixturePackInterface;

interface PackerInterface
{
    /**
     * @param EntityCollection $entityCollection
     *
     * @return FixturePackInterface
     */
    public function pack(EntityCollection $entityCollection);

    /**
     * @param FixturePackInterface $fixturePack
     *
     * @return mixed $entity
     */
    public function unpack(FixturePackInterface $fixturePack);
}