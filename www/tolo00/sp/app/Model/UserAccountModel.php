<?php

namespace App\Model;

use App\Model\Entity\UserAccount;
use Nettrine\ORM\EntityManagerDecorator;

class UserAccountModel extends BaseModel
{

    public function __construct(EntityManagerDecorator $entityManager)
    {
        parent::__construct($entityManager, UserAccount::class);
    }

}
