<?php

namespace App\Model;

use App\Model\Entity\PostTopic;
use Nettrine\ORM\EntityManagerDecorator;

class PostTopicModel extends BaseModel
{

    public function __construct(EntityManagerDecorator $entityManager)
    {
        parent::__construct($entityManager, PostTopic::class);
    }

}
