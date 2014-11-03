<?php

namespace Truelab\Bundle\FixtureBundle\Parser;

use Truelab\Bundle\FixtureBundle\Fixture\Fixture;
use Truelab\Bundle\FixtureBundle\Fixture\FixtureInterface;
use Truelab\Bundle\FixtureBundle\Fixture\Pack\FixturePack;
use Truelab\Bundle\FixtureBundle\Fixture\Pack\FixturePackInterface;

class ArrayParser implements ParserInterface
{
    /**
     * @param $data
     *
     * @return FixturePackInterface
     */
    public function decode($data)
    {
        $fixturePack = new FixturePack();
        $fixturePack->setClassName($data['class']);
        foreach ($data['fixtures'] as $key => $fixtureData) {
            $fixturePack->addFixture($this->decodeFixture($key, $fixtureData));
        }

        return $fixturePack;
    }

    /**
     * @param FixturePackInterface $fixturePack
     *
     * @return mixed
     */
    public function encode(FixturePackInterface $fixturePack)
    {
        $data = array();
        $fixtures = $fixturePack->getFixtures();
        $data['short_name'] = $fixturePack->getShortName();
        $data['class'] = $fixturePack->getClassName();
        $data['fixtures'] = array();
        foreach ($fixtures as $fixture) {
            /** @var FixtureInterface $fixture */
            $data['fixtures'][$fixture->getId()] = $this->encodeFixture($fixture);
        }

        return $data;
    }

    /**
     * @param $key
     * @param $fixtureData
     *
     * @return Fixture
     */
    public function decodeFixture($key, $fixtureData)
    {
        $fixture = new Fixture();
        $fixture->setId($key);
        foreach ($fixtureData as $key => $value) {
            $fixture->setProperty($key, $value);
        }

        return $fixture;
    }

    /**
     * @param FixtureInterface $fixture
     * @return array
     */
    public function encodeFixture(FixtureInterface $fixture)
    {
        $properties = $fixture->getProperties();

        return $properties;
    }
}