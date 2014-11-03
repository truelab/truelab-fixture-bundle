<?php

namespace Truelab\Bundle\FixtureBundle\Util;

use Truelab\Bundle\FixtureBundle\Fixture\FixtureInterface;
use Truelab\Bundle\FixtureBundle\Key\Method;
use Truelab\Bundle\FixtureBundle\Key\Property;

class Identificator
{
    public function getFromEntity($entity)
    {
        $method = Method::GET_PRETTY_ID;
        if (method_exists($entity, $method)) {
            return $entity->$method();
        }
        return $entity->getId();
    }

    public function getFromFixture(FixtureInterface $fixture)
    {
        return $fixture->getId();
    }

    public function getIdPropertyName($className)
    {
        $reflectionClass = new \ReflectionClass($className);
        if ($reflectionClass->hasMethod(Method::GET_PRETTY_ID)) {
            return Property::PRETTY_ID;
        }

        return 'id';
    }

}