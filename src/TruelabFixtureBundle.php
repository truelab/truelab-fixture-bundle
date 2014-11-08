<?php

namespace Truelab\Bundle\FixtureBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Truelab\Bundle\FixtureBundle\DependencyInjection\FixtureManagerCompilerPass;

/**
 * Class TruelabFixtureBundle
 *
 * @package Truelab\Bundle\FixtureBundle
 */
class TruelabFixtureBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new FixtureManagerCompilerPass());
    }
}
