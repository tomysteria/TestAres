<?php

namespace Ares\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AresCoreBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function listTasksAction()
    {
        return $this->render('AresCoreBundle:Default:listTasks.html.twig');
    }    
}
