<?php

namespace Vanbrabantf\Blog\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    public function indexAction($page)
    {
        $postManager    = $this->get("vanbrabantf_blog_core.Post");
        $posts          = $postManager->getPagedPosts((integer)$page);

        return $this->render('VanbrabantfBlogCoreBundle:Blog:overview.html.twig', array('posts' => $posts, "page" => $page));
    }

    public function pageAction($id)
    {
        $postManager    = $this->get("vanbrabantf_blog_core.Post");
        $post          = $postManager->getPostById((integer)$id);

        return $this->render('VanbrabantfBlogCoreBundle:Blog:post.html.twig', array('post' => $post));
    }
}
