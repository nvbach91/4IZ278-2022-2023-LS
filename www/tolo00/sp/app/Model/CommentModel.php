<?php

namespace App\Model;

use App\Model\Entity\Comment;
use Nettrine\ORM\EntityManagerDecorator;

class CommentModel extends BaseModel
{

    public function __construct(EntityManagerDecorator $entityManager)
    {
        parent::__construct($entityManager, Comment::class);
    }

    public function findAllPostCommentsCount()
    {
        $qb = $this->getQueryBuilder('pc');
        $qb->select('COUNT(pc) as postsCommentsCount');
        $qb->andWhere('pc.parentComment IS NULL');

        return $qb->getQuery()->getSingleScalarResult();
    }

}
