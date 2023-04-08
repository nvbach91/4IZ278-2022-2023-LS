<?php

namespace App\Model;

use App\Model\Entity\Post;
use App\Model\Entity\UserAccount;
use Nettrine\ORM\EntityManagerDecorator;

class PostModel extends BaseModel
{

    public function __construct(EntityManagerDecorator $entityManager)
    {
        parent::__construct($entityManager, Post::class);
    }

}
