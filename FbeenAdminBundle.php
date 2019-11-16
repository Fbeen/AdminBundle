<?php

namespace Fbeen\AdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Fbeen\AdminBundle\DependencyInjection\Compiler\AdminPass;

/**
 * This is the "Unique slug bundle". It creates unique slugs from entity properties or a method
 * and store them into the slug property and the slug column of the entity's table.
 *
 * @author Frank Beentjes <frankbeen@gmail.com>
 */
class FbeenAdminBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AdminPass());
    }
}
