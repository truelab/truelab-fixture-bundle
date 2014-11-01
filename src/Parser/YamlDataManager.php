<?php

namespace Truelab\Bundle\FixtureBundle\Parser;

use Symfony\Component\Yaml\Dumper;
use Symfony\Component\Yaml\Parser;

class YamlDataManager implements DataManagerInterface
{

    protected $yamlParser;
    protected $rootDir;
    protected $yamlDumper;

    /**
     * @param string $rootDir
     */
    public function __construct($rootDir)
    {
        $this->yamlParser = new Parser();
        $this->rootDir = $rootDir;
        $this->fixtureDir = $rootDir . '/fixtures/';
        $this->yamlDumper = new Dumper();
    }

    /**
     * @param string $className
     *
     * @return mixed $data
     */
    public function load($className)
    {
        $data = $this->yamlParser->parse(file_get_contents($this->getPath(str_replace('\\', '_', strtolower($className)))));

        return $data;
    }

    /**
     * @param mixed $data
     *
     * @return mixed
     */
    public function save($data)
    {
        $yaml = $this->yamlDumper->dump($data, 3);
        if (!is_dir($this->fixtureDir)) {
            mkdir($this->fixtureDir);
        }

        file_put_contents($this->getPath($data['short_name']), $yaml);
    }

    public function getPath($shortName)
    {
         return $this->fixtureDir . $shortName .'.yml';
    }
}