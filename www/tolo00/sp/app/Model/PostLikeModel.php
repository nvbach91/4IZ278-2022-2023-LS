<?php

namespace App\Model;

use App\Model\Entity\PostLike;
use Nettrine\ORM\EntityManagerDecorator;

class PostLikeModel extends BaseModel
{

    public function __construct(EntityManagerDecorator $entityManager)
    {
        parent::__construct($entityManager, PostLike::class);
    }

    public function findAllCount()
    {
        $qb = $this->getQueryBuilder('pl');
        $qb->select('COUNT(pl) as postsLikesCount');

        return $qb->getQuery()->getSingleScalarResult();
    }

}
