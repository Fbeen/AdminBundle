<?php

namespace Fbeen\AdminBundle\Admin;

use Symfony\Component\HttpKernel\Exception\HttpNotFoundException;

/**
 * Description of AdminChain
 *
 * @author Frank Beentjes <frankbeen@gmail.com>
 */
class AdminChain 
{
    private $admins;

    public function __construct()
    {
        $this->admins = [];
    }

    public function addAdmin(AdminInterface $admin)
    {
        $this->admins[] = $admin;
    }
    
    public function getAdmins()
    {
        return $this->admins;
    }
    
    public function findAdminBySLug($slug)
    {
        foreach($this->admins as $admin)
        {
            if($admin->getSlug() == $slug) {
                return $admin;
            }
        }
        
        throw new HttpNotFoundException('No admin class found with slug ' . $slug);
    }
}
