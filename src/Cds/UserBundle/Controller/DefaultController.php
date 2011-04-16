<?php

namespace Cds\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CdsUserBundle:Default:index.html.twig');
    }
}
