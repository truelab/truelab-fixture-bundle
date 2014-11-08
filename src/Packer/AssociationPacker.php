<?php

namespace Truelab\Bundle\FixtureBundle\Packer;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Column;
use Truelab\Bundle\FixtureBundle\Entity\EntityCollection;
use Truelab\Bundle\FixtureBundle\Fixture\Fixture;
use Truelab\Bundle\FixtureBundle\Fixture\FixtureInterface;
use Truelab\Bundle\FixtureBundle\Fixture\Pack\FixturePack;
use Truelab\Bundle\FixtureBundle\Fixture\Pack\FixturePackInterface;
use Truelab\Bundle\FixtureBundle\Key\Method;
use Truelab\Bundle\FixtureBundle\Key\Property;
use Truelab\Bundle\FixtureBundle\Util\Identificator;

class AssociationPacker extends Packer
{
    protected $entityManager;
    protected $identificator;

    /**
     * __construct
     */
    public function __construct(AssociationAnalyzer $associationAnalyzer, EntityManager $entityManager)
    {
        $this->analyzers = array($associationAnalyzer);
        $this->entityManager = $entityManager;
        $this->identificator = new Identificator();
    }


    /**
     * @param FixturePackInterface $fixturePack
     *
     * @throws \Exception
     * @return mixed $entity
     */
    public function unpack(FixturePackInterface $fixturePack)
    {
       $entityCollection = new EntityCollection();
        $className = $fixturePack->getClassName();
        $entityCollection->setClassName($className);
        $idPropertyName = $this->identificator->getIdPropertyName($className);
        $repository = $this->entityManager->getRepository($className);
        foreach ($fixturePack->getFixtures() as $fixture) {
            $entity = $repository->findOneBy(array($idPropertyName=>$fixture->getId()));
            if (!$entity) {
                throw new \Exception('Entity not found with id ' . $fixture->getProperty('id'));
            }
            $reflectionClass = new \ReflectionClass($entity);
            $reflectionProperties = $reflectionClass->getProperties();
            foreach ($reflectionProperties as $reflectionProperty) {
                $reflectionProperty->setAccessible(true);
                foreach ($this->analyzers as $analyzer) {
                    /** @var PropertyAnalyzerInterface $analyzer */
                    $analyzer->fromFixture($reflectionProperty, $fixture, $entity);
                }
            }
            $entityCollection->addEntity($entity);
        }

        return $entityCollection;
    }

}
