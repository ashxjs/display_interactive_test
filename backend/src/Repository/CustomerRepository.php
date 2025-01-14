<?php

namespace App\Repository;

use App\Entity\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CustomerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customer::class);
    }

    public function findAll(): array
    {
        return $this->getEntityManager()->getRepository(Customer::class)
            ->createQueryBuilder('c')
            ->select()
            ->getQuery()
            ->getResult()
        ;
    }

    public function findById(string $customerId): ?Customer
    {
        return $this->getEntityManager()->getRepository(Customer::class)->find($customerId);
    }

    public function insertBulk(array $customers): void
    {
        foreach ($customers as $customer) {
            $customerExist = $this->findById($customer->getId());

            if ($customerExist) {
                dump('user already exist ' . $customer->getId());
            } else {
                $this->getEntityManager()->persist($customer);
            }
        }
        $this->getEntityManager()->flush();
    }
}
