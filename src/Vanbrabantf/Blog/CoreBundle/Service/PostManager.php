<?php

namespace Vanbrabantf\Blog\CoreBundle\Service;

use Doctrine\Common\Cache\ArrayCache;
use Vanbrabantf\Blog\CoreBundle\Entity\Post;
use Doctrine\Common\Persistence\ManagerRegistry;

class PostManager
{
    private $doctrine;
    private $entityManager;
    private $repository;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine             = $doctrine;
        $this->entityManager        = $this->doctrine->getManagerForClass(get_class(new Post()));
        $this->repository           = $this->entityManager->getRepository('VanbrabantfBlogCoreBundle:Post');
    }

    /**
     * @param int $page the current page
     * @param int $postsPerPage how many pages we should show per page
     * @return mixed
     */
    public function getPagedPosts($page = 0, $postsPerPage = 2)
    {
        $query = $this->entityManager->createQueryBuilder()
                                ->select('p')
                                ->from('VanbrabantfBlogCoreBundle:Post', 'p')
                                ->orderBy('p.createdAt', 'DESC')
                                ->setFirstResult( $page * $postsPerPage )
                                ->setMaxResults( $postsPerPage + 1 )
                                ->getQuery();

        $postCollection = $query->getResult();
        $hasNextPage    = $this->hasNextPage($postCollection, $postsPerPage);

        // this removes the extra "check" row
        // kinda hacky, but removes the overhead of a pagination bundle
        if($hasNextPage){
            array_pop($postCollection);
        }

        $posts = Array("hasNextPage" => $hasNextPage, "postCollection" => $postCollection);

        return $posts;
    }

    /**
     * returns the linked Post
     * @param $id postId
     * @return Post
     */
    public function getPostById($id)
    {
        return $this->repository->findOneById($id);
    }

    /**
     * This is a very simplistic way to implement pagination
     * Normally one should use a pagination bundle (especially if an API is involved).
     * I suggest whiteoctober/Pagerfanta or KnpLabs/KnpPaginatorBundle
     *
     * @param $postCollection collection of posts
     * @param $postsPerPage how many posts a page should contain
     * @return bool is there is a page after this page
     */
    private function hasNextPage($postCollection, $postsPerPage)
    {
        if($postsPerPage < count($postCollection)) {
            return true;
        }
        return false;
    }

}
