<?php

namespace Fbeen\AdminBundle\Admin;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of ContactAdmin
 *
 * @author Frank Beentjes <frankbeen@gmail.com>
 */
abstract class AbstractAdmin implements AdminInterface
{
    protected $options;
    
    public function __construct(array $options = [])
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        $resolver->setRequired('entity');
        $resolver->setRequired('slug');
        $resolver->setRequired('label');

        $this->options = $resolver->resolve($options);
    }
    
    public function getEntity()
    {
        return $this->options['entity'];
    }
    
    public function getLabel()
    {
        return $this->options['label'];
    }
    
    public function getSlug()
    {
        return $this->options['slug'];
    }
    
    public function getIcon()
    {
        return $this->options['icon'];
    }
}
