<?php

namespace App\Repository;

use App\Entity\Customer;
use App\Entity\Purchase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\Persistence\ManagerRegistry;

class PurchaseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Purchase::class);
    }

    public function findAll(): array
    {
        return parent::findAll();
    }

    public function findById(string $id): ?Purchase
    {
        return $this->getEntityManager()->getRepository(Purchase::class)->find($id);
    }

    public function insertBulk(array $purchases): void
    {
        foreach ($purchases as $purchase) {
            $purchaseExist = $this->findById($purchase->getId());

            if ($purchaseExist) {
                dump('purchase already exist ' . $purchase->getId());
            } else {
                $this->getEntityManager()->persist($purchase);
            }
        }
        $this->getEntityManager()->flush();
    }

    public function getAllByCustomerId(int $id, Customer $customer): array
    {
        return $this->createQueryBuilder('p')
            ->select()
            ->where('p.customer = :customer')
            ->setParameter('customer', $customer)
            ->getQuery()
            ->getResult();
    }
}
