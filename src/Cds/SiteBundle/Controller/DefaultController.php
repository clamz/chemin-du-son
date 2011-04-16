<?php

namespace Cds\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CdsSiteBundle:Default:index.html.twig');
    }
}
