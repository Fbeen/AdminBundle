<?php

namespace Fbeen\AdminBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\OptionsResolver\Exception\InvalidArgumentException;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class FbeenAdminExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container) : void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');
        
        $this->registerContainerParametersRecursive($container, $this->getAlias(), $config);
    }
    /**
     * Set all parameters of this bundle in the container
     * 
     * @param ContainerBuilder $container The container builder
     * @param string $alias Alias name of this bundle e.g. fbeen_unique_slug
     * @param array $config All configuration variables for this bundle
     */
    protected function registerContainerParametersRecursive(ContainerBuilder $container, string $alias, array $config) : void
    {
        $iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($config),
            \RecursiveIteratorIterator::SELF_FIRST);
        foreach ($iterator as $value) {
            $path = array( );
            for ($i = 0; $i <= $iterator->getDepth(); $i++) {
                $path[] = $iterator->getSubIterator($i)->key();
            }
            $key = $alias . '.' . implode(".", $path);
            $container->setParameter($key, $value);
        }
    }
}