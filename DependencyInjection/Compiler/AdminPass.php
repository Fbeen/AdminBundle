<?php

namespace Fbeen\AdminBundle\DependencyInjection\Compiler;

use Fbeen\AdminBundle\Admin\AdminChain;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class AdminPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        // always first check if the primary service is defined
        if (!$container->has(AdminChain::class)) {
            return;
        }
 
        $definition = $container->findDefinition(AdminChain::class);

        // find all service IDs with the app.mail_transport tag
        $taggedServices = $container->findTaggedServiceIds('fbeen.admin');

        foreach ($taggedServices as $id => $tags) {
            // add the transport service to the TransportChain service
            $definition->addMethodCall('addAdmin', [new Reference($id)]);
        }
    }
}