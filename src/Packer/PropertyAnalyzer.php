<?php

namespace Truelab\Bundle\FixtureBundle\Packer;


use Doctrine\ORM\EntityManager;
use Truelab\Bundle\FixtureBundle\Fixture\FixtureInterface;

/**
 * Class PropertyAnalyzer
 *
 * @package Truelab\Bundle\FixtureBundle\Packer
 */
class PropertyAnalyzer implements PropertyAnalyzerInterface
{

    protected $entityManager;
    protected $metadataFactory;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->metadataFactory = $this->entityManager->getMetadataFactory();
    }

    /**
     * @param \ReflectionProperty $reflectionProperty
     * @param FixtureInterface    $fixture
     * @param mixed               $entity
     */
    public function fromEntity(\ReflectionProperty $reflectionProperty, FixtureInterface $fixture, $entity)
    {
        $value = $reflectionProperty->getValue($entity);
        $name = $reflectionProperty->getName();
        $classMetadata = $this->metadataFactory->getMetadataFor(get_class($entity));

        if (!$classMetadata->hasField($name)) {
            return;
        }

        $this->setFixtureProperty($fixture, $name, $value);
    }

    /**
     * @param \ReflectionProperty $reflectionProperty
     * @param FixtureInterface    $fixture
     * @param mixed               $entity
     */
    public function fromFixture(\ReflectionProperty $reflectionProperty, FixtureInterface $fixture, $entity)
    {
        $name = $reflectionProperty->getName();
        $classMetadata = $this->metadataFactory->getMetadataFor(get_class($entity));
        if (!$classMetadata->hasField($name)) {
            return;
        }
        $this->setEntityProperty($entity, $fixture, $reflectionProperty, $classMetadata->getTypeOfField($name));
    }

    /**
     * @param FixtureInterface $fixture
     * @param string           $name
     * @param string           $value
     */
    public function setFixtureProperty(FixtureInterface $fixture, $name, $value)
    {
        if (!is_object($value)) {
            $fixture->setProperty($name, $value);
        } else if ($value instanceof \DateTime) {
            $fixture->setProperty($name, $value->format(\DateTime::ISO8601));
        }
    }

    /**
     * @param mixed               $entity
     * @param FixtureInterface    $fixture
     * @param \ReflectionProperty $reflectionProperty
     * @param string              $fieldType
     */
    public function setEntityProperty($entity, FixtureInterface $fixture, \ReflectionProperty $reflectionProperty, $fieldType)
    {

        $value = $fixture->getProperty($reflectionProperty->getName());

        if ($fieldType === 'datetime') {
            $reflectionProperty->setValue($entity, new \DateTime($value));
        } else {
            $reflectionProperty->setValue($entity, $value);
        }
    }

}