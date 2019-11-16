<?php

namespace Fbeen\AdminBundle\Admin;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of AdminInterface
 *
 * @author Frank Beentjes <frankbeen@gmail.com>
 */
interface AdminInterface 
{
    public function configureOptions(OptionsResolver $resolver);
}
