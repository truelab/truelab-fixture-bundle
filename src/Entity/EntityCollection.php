<?php

namespace Truelab\Bundle\FixtureBundle\Entity;

class EntityCollection implements EntityCollectionInterface
{

    protected $entities;
    protected $className;

    /**
     * @param array $array
     */
    public function __construct($array = array())
    {
        $this->entities = $array;
    }

    public function addEntity($entity)
    {
        $this->entities[] = $entity;
    }

    /**
     * @param array $entities
     */
    public function setEntities($entities)
    {
        $this->entities = $entities;
    }

    /**
     * @return array
     */
    public function getEntities()
    {
        return $this->entities;
    }

    /**
     * @param string $className
     */
    public function setClassName($className)
    {
        $this->className = $className;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }





}