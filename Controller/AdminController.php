<?php

namespace Fbeen\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Fbeen\AdminBundle\Admin\AdminChain;
use Fbeen\AdminBundle\Admin\AdminInterface;

class AdminController extends AbstractController
{
    private $chain;
    private $admins;
    
    public function __construct(AdminChain $chain) 
    {
        $this->chain = $chain;
        $this->admins = $chain->getAdmins();
    }

    public function dashboardAction(): Response
    {
        // $value = $this->getParameter('fbeen_admin.test');
        foreach($this->admins as $admin)
        {
            echo $admin->getEntity();
        }
        
        return $this->render('@FbeenAdmin/admin/dashboard.html.twig',[
            'admins' => $this->admins
        ]);
    }

    public function index($slug): Response
    {
        $admin = $this->chain->findAdminBySLug($slug);
        
        $em = $this->getDoctrine()->getManager();
        
        $objects = $em->getRepository($admin->getEntity())->findAll();
        
        return $this->render('@FbeenAdmin/admin/index.html.twig',[
            'admins' => $this->admins,
            'objects' => $objects
        ]);
    }

}
