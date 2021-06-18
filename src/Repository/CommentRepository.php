<?php


namespace App\Repository;


use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

class CommentRepository extends NestedTreeRepository
{
    public function findForPostId(int $postId)
    {
        dd($this->getRootNodesQueryBuilder()
//            ->andWhere('comments.post_id=:post')
//            ->setParameter('post', $postId)
            ->getQuery());
//            ->getResult();
    }
}