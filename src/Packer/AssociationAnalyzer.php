<?php

namespace Truelab\Bundle\FixtureBundle\Packer;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\EntityManager;
use Truelab\Bundle\FixtureBundle\Entity\EntityCollection;
use Truelab\Bundle\FixtureBundle\Fixture\FixtureInterface;
use Truelab\Bundle\FixtureBundle\Fixture\Pack\FixturePackInterface;
use Truelab\Bundle\FixtureBundle\Key\Method;

class AssociationAnalyzer implements PropertyAnalyzerInterface
{

    protected $entityManager;
    protected $metadataFactory;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->metadataFactory = $this->entityManager->getMetadataFactory();
    }

    /**
     * @param \ReflectionProperty $reflectionProperty
     * @param FixtureInterface $fixture
     * @param $entity
     */
    public function fromEntity(\ReflectionProperty $reflectionProperty, FixtureInterface $fixture, $entity)
    {
        $name = $reflectionProperty->getName();
        $value = $reflectionProperty->getValue($entity);
        $classMetadata = $this->metadataFactory->getMetadataFor(get_class($entity));
        if (!$classMetadata->hasAssociation($name)) {
            return;
        }

        if ($classMetadata->isCollectionValuedAssociation($name)) {
            $this->setFixtureAssociations($fixture, $name, $value);
        } else if ($classMetadata->isSingleValuedAssociation($name)) {
            $this->setFixtureAssociation($fixture, $name, $this->getPrettyId($value));
        }
    }

    /**
     * @param \ReflectionProperty $reflectionProperty
     * @param FixtureInterface $fixture
     * @param $entity
     */
    public function fromFixture(\ReflectionProperty $reflectionProperty, FixtureInterface $fixture, $entity)
    {
        $name = $reflectionProperty->getName();
        $value = $fixture->getProperty($name);
        $classMetadata = $this->metadataFactory->getMetadataFor(get_class($entity));
        if (!$classMetadata->hasAssociation($name)) {
            return;
        }
        if (is_null($value)) {
            return;
        }

        if ($classMetadata->isCollectionValuedAssociation($name)) {
            $this->setEntityAssociations($entity, $reflectionProperty, $value, $classMetadata->getAssociationTargetClass($name));
        } else if ($classMetadata->isSingleValuedAssociation($name)) {
            $this->setEntityAssociation($entity, $reflectionProperty, $value, $classMetadata->getAssociationTargetClass($name));
        }

    }

    /**
     * @param mixed               $entity
     * @param \ReflectionProperty $reflectionProperty
     * @param integer             $id
     * @param string              $targetEntityClass
     */
    public function setEntityAssociation($entity, $reflectionProperty, $id, $targetEntityClass)
    {
        try {
            $repository = $this->entityManager->getRepository($targetEntityClass);
            $object = $repository->find($id);
            if ($object) {
                $reflectionProperty->setValue($entity, $object);
            } else {
                echo $targetEntityClass . ' ' . $id . PHP_EOL;
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }

    /**
     * @param mixed               $entity
     * @param \ReflectionProperty $reflectionProperty
     * @param array               $ids
     * @param string              $targetEntityClass
     */
    public function setEntityAssociations($entity, $reflectionProperty, $ids, $targetEntityClass)
    {
        try {
            $repository = $this->entityManager->getRepository($targetEntityClass);
            $collection = array();
            foreach ($ids as $id) {
                $object = $repository->find($id);
                if ($object) {
                    $collection[] = $object;
                } else {
                    echo $targetEntityClass . ' ' . $id . PHP_EOL;
                }
            }
            $reflectionProperty->setValue($entity, $collection);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }


    /**
     * @param FixtureInterface $fixture
     * @param $name
     * @param $value
     */
    public function setFixtureAssociations(FixtureInterface $fixture, $name, $value)
    {
        $ids = array();
        foreach ($value as $object) {
            $ids[] = $this->getPrettyId($object);
        }
        $fixture->setProperty($name, $ids);
    }

    /**
     * @param FixtureInterface $fixture
     * @param string $name
     * @param string $value
     */
    public function setFixtureAssociation(FixtureInterface $fixture, $name, $value)
    {
        if (!is_object($value)) {
            $fixture->setProperty($name, $value);
        } else if ($value instanceof \DateTime) {
            $fixture->setProperty($name, $value->format(\DateTime::ISO8601));
        }
    }

    /**
     * @param  $object
     * @return mixed
     */
    public function getPrettyId($object)
    {
        if (!$object) {
            return null;
        }
        $reflectionClass = new \ReflectionClass($object);
        if ($reflectionClass->hasMethod(Method::GET_PRETTY_ID)) {
            // return $object->getPrettyId();
        }

        return $object->getId();
    }
}