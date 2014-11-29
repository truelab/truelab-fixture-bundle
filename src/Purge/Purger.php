<?php

namespace Truelab\Bundle\FixtureBundle\Purge;

use Doctrine\ORM\EntityManager;

class Purger
{
    protected $entityManager;


    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * purge
     */
    public function purge()
    {
        $connection = $this->entityManager->getConnection();
        $schemaManager = $connection->getSchemaManager();
        $tables = $schemaManager->listTables();
        $query = 'SET FOREIGN_KEY_CHECKS=0;';

        foreach($tables as $table) {
            $name = $table->getName();
            if ($name[0] !== '_') {
                $query .= 'TRUNCATE ' . $name . ';';
                $query .= 'ALTER TABLE ' . $name . ' AUTO_INCREMENT = 1;';
            }
        }
        $query .= 'SET FOREIGN_KEY_CHECKS=1;';

        $connection->executeQuery($query, array(), array());
    }
}