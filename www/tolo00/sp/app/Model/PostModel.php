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

    public function findAllCount()
    {
        $qb = $this->getQueryBuilder('p');
        $qb->select('COUNT(p) as postsCount');

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function findForHomepage(int|string $topic = null, int $limit, int $offset = null)
    {
        $qb = $this->getQueryBuilder('p');

        if ($topic) {
            $qb->andWhere(':topic MEMBER OF p.topics');
            $qb->setParameter('topic', (int)$topic);
        }

        $qb->orderBy('p.dateCreated', 'DESC');

        $qb->setMaxResults($limit);

        if ($offset) {
            $qb->setFirstResult($offset);
        }

        return $qb->getQuery()->getResult();
    }

}
