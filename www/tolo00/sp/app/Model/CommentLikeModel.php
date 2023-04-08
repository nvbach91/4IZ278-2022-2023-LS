<?php

namespace App\Model;

use App\Model\Entity\CommentLike;
use Nettrine\ORM\EntityManagerDecorator;

class CommentLikeModel extends BaseModel
{

    public function __construct(EntityManagerDecorator $entityManager)
    {
        parent::__construct($entityManager, CommentLike::class);
    }

}
