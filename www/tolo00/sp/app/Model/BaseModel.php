<?php

namespace App\Model;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ObjectRepository;
use Nette\Utils\Arrays;

abstract class BaseModel
{

    private EntityManagerInterface $em;

    protected ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager, string $entityClassName)
    {
        $this->em = $entityManager;
        $this->repository = $this->em->getRepository($entityClassName);
    }

    //////////////////////////////////////////////////////// Reporitory

    public function find(string|int $id = null): ?object
    {
        return $id ? $this->repository->find($id) : null;
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function findBy(array $criteria, array $order = null, int $limit = null, int $offset = null): array
    {
        return $this->repository->findBy($criteria, $order, $limit, $offset);
    }

    public function findOneBy(array $criteria): ?object
    {
        return $this->repository->findOneBy($criteria);
    }

    public function findPairs(array $criteria = [], string $pairedColumn = 'title', array $orderBy = []): array
    {
        $qb = $this->getQueryBuilder();
        $qb->select("e.id, e.{$pairedColumn}");

        foreach ($criteria as $column => $value) {
            $qb->andWhere("e.{$column} = :{$column}");
            $qb->setParameter($column, $value);
        }

        if ($orderBy) {
            foreach ($orderBy as $column => $order) {
                $qb->orderBy("e.{$column}", $order);
            }
        } else {
            $qb->orderBy("e.{$pairedColumn}", 'ASC');
        }

        return (array)Arrays::associate($qb->getQuery()->getResult(), "id={$pairedColumn}");
    }

    //////////////////////////////////////////////////////// Query builder

    public function createQueryBuilder(): QueryBuilder
    {
        return $this->em->createQueryBuilder();
    }

    public function getQueryBuilder(string $alias = 'e'): QueryBuilder
    {
        $qb = $this->createQueryBuilder();
        $qb->select($alias);
        $qb->from($this->repository->getClassName(), $alias);

        return $qb;
    }

    //////////////////////////////////////////////////////// Saving

    public function save($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    public function saveDelayed($entity)
    {
        $this->em->persist($entity);

        return $entity;
    }

    public function delete($entity)
    {
        $this->em->remove($entity);
        $this->em->flush();

        return $entity;
    }

    public function deleteDelayed($entity)
    {
        $this->em->remove($entity);

        return $entity;
    }

    public function flushAll(): void
    {
        $this->em->flush();
    }

}
