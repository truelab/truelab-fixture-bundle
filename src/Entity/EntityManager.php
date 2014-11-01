<?php

namespace Truelab\Bundle\FixtureBundle\Entity;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager as DoctrineEntityManager;

class EntityManager implements EntityManagerInterface
{
    /** @var DoctrineEntityManager $entityManager */
    protected $entityManager;

    /** @var Connection $connection */
    protected $connection;

    /**
     * @param DoctrineEntityManager $entityManager
     */
    public function __construct(DoctrineEntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->connection = $this->entityManager->getConnection();
    }

    /**
     * @param EntityCollection $entityCollection
     * @return mixed|void
     */
    public function save(EntityCollection $entityCollection)
    {
        foreach ($entityCollection->getEntities() as $entity) {
            $this->entityManager->persist($entity);
        }

        $this->entityManager->flush();
    }

    /**
     * @param string $className
     *
     * @return array
     */
    public function load($className)
    {
        $repository = $this->entityManager->getRepository($className);
        $entities = $repository->findAll();
        $entityCollection = new EntityCollection($entities);
        $entityCollection->setClassName($className);

        return $entityCollection;
    }


}