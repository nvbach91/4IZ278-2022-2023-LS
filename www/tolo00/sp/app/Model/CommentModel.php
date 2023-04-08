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

}
