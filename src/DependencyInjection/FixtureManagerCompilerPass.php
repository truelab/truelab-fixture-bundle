<?php

namespace Truelab\Bundle\FixtureBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class FixtureManagerCompilerPass
 *
 * @package Truelab\Bundle\FixtureBundle\DependencyInjection
 */
class FixtureManagerCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $this->addManagers($container, 'truelab_fixture.import_process', 'truelab_fixture.import_fixture_manager');
        $this->addManagers($container, 'truelab_fixture.export_process', 'truelab_fixture.export_fixture_manager');
    }

    /**
     * @param ContainerBuilder $container
     * @param string           $processName
     * @param string           $tagName
     */
    public function addManagers(ContainerBuilder $container, $processName, $tagName)
    {
        if (!$container->hasDefinition($processName)) {
            return;
        }
        $definition = $container->getDefinition($processName);
        $taggedServices = $container->findTaggedServiceIds($tagName);
        foreach ($taggedServices as $id => $attributes) {
            $definition->addMethodCall(
                'addFixtureManager',
                array(new Reference($id))
            );
        }
    }
}