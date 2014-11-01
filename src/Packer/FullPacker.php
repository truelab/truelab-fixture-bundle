<?php

namespace Truelab\Bundle\FixtureBundle\Packer;

use Doctrine\ORM\Mapping\Column;
use Truelab\Bundle\FixtureBundle\Entity\EntityCollection;
use Truelab\Bundle\FixtureBundle\Fixture\Fixture;
use Truelab\Bundle\FixtureBundle\Fixture\FixtureInterface;
use Truelab\Bundle\FixtureBundle\Fixture\Pack\FixturePack;
use Truelab\Bundle\FixtureBundle\Fixture\Pack\FixturePackInterface;
use Truelab\Bundle\FixtureBundle\Key\Method;
use Truelab\Bundle\FixtureBundle\Key\Property;

class FullPacker extends Packer
{

    /**
     * __construct
     */
    public function __construct(PropertyAnalyzer $propertyAnalyzer, AssociationAnalyzer $associationAnalyzer)
    {
        $this->analyzers = array($propertyAnalyzer, $associationAnalyzer);
    }

}