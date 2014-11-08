<?php

namespace Truelab\Bundle\FixtureBundle\Fixture\Manager;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Truelab\Bundle\FixtureBundle\Entity\EntityManagerInterface;
use Truelab\Bundle\FixtureBundle\Event\EncodedDataEvent;
use Truelab\Bundle\FixtureBundle\Event\EntityCollectionEvent;
use Truelab\Bundle\FixtureBundle\Event\FixturePackEvent;
use Truelab\Bundle\FixtureBundle\Packer\PackerInterface;
use Truelab\Bundle\FixtureBundle\Parser\DataManagerInterface;
use Truelab\Bundle\FixtureBundle\Parser\ParserInterface;

/**
 * Class FixtureManager
 *
 * @package Truelab\Bundle\FixtureBundle\Fixture\Manager
 */
class FixtureManager implements FixtureManagerInterface
{
    /** @var ParserInterface $parser */
    protected $parser;

    /** @var PackerInterface $packer */
    protected $packer;

    /** @var EntityManagerInterface $entityManager */
    protected $entityManager;

    /** @var DataManagerInterface $dataManager */
    protected $dataManager;

    /** @var EventDispatcherInterface */
    protected $dispatcher;

    /**
     * @param ParserInterface          $parser
     * @param PackerInterface          $packer
     * @param EntityManagerInterface   $entityManager
     * @param DataManagerInterface     $dataManager
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(
        ParserInterface $parser,
        PackerInterface $packer,
        EntityManagerInterface $entityManager,
        DataManagerInterface $dataManager,
        EventDispatcherInterface $dispatcher)
    {
        $this->parser = $parser;
        $this->packer = $packer;
        $this->entityManager = $entityManager;
        $this->dataManager = $dataManager;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param string $className
     */
    public function import($className)
    {
        $data = $this->dataManager->load($className);
        $this->dispatcher->dispatch('truelab_fixture.data_manager_load', new EncodedDataEvent($data));

        $fixturePack = $this->parser->decode($data);
        $this->dispatcher->dispatch('truelab_fixture.parser_decode', new FixturePackEvent($fixturePack));

        $entityCollection = $this->packer->unpack($fixturePack);
        $this->dispatcher->dispatch('truelab_fixture.packer_unpack', new EntityCollectionEvent($entityCollection));

        $this->entityManager->save($entityCollection);
    }

    /**
     * @param string $className
     */
    public function export($className)
    {
        $entityCollection = $this->entityManager->load($className);
        $this->dispatcher->dispatch('truelab_fixture.entity_manager_load', new EntityCollectionEvent($entityCollection));

        $fixturePack = $this->packer->pack($entityCollection);
        $this->dispatcher->dispatch('truelab_fixture.packer_pack', new FixturePackEvent($fixturePack));

        $data = $this->parser->encode($fixturePack);
        $this->dispatcher->dispatch('truelab_fixture.parser_encode', new EncodedDataEvent($data));

        $this->dataManager->save($data);
    }
}