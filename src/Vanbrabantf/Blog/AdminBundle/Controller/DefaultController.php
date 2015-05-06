<?php

namespace Vanbrabantf\Blog\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('VanbrabantfBlogAdminBundle:Default:index.html.twig', array('name' => $name));
    }
}
