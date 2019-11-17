# FbeenAdminBundle for Symfony 4

### This bundle is under development!

/config/routes.yaml
```
# fbeen-admin
admin_area:
    resource: "@FbeenAdminBundle/Resources/config/routing.yaml"
    prefix: /testje
```

/src/Admin/ContactAdmin.yaml
```
<?php

namespace App\Admin;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Fbeen\AdminBundle\Admin\AbstractAdmin;
use App\Entity\Contact;

/**
 * Description of ContactAdmin
 *
 * @author Frank Beentjes <frankbeen@gmail.com>
 */
class ContactAdmin extends AbstractAdmin
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'entity' => Contact::class,
            'label' => 'Contactverzoeken',
            'icon' => 'fas fa-phone-volume',
            'slug' => 'contactverzoeken',
        ]);
    }
    
    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->addIdentifier('__toString', null, ['label' => 'Adres'])
            ->add('description', null, ['label' => 'Zoeknaam'])
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }
}
```

config/services.yaml
```

    # admins are imported separately to make sure services can be injected
    # as action arguments even if you don't extend any base admin class
    App\Admin\:
        resource: '../src/Admin'
        tags: ['fbeen.admin']
```
