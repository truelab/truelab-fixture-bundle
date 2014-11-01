<?php

namespace Truelab\Bundle\FixtureBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TruelabFixtureBundle:Default:index.html.twig', array('name' => $name));
    }
}
