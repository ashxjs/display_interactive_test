<?php

namespace App\Services;

use App\Entity\Customer;
use App\Repository\PurchaseRepository;

class PurchaseService
{

    private PurchaseRepository $purchaseRepository;

    public function __construct(PurchaseRepository $purchaseRepository)
    {
        $this->purchaseRepository = $purchaseRepository;
    }

    public function insertBulk(array $purchases): void
    {
        $this->purchaseRepository->insertBulk($purchases);
    }

    public function getAllByCustomerId(int $id, Customer $customer): array
    {
        return $this->purchaseRepository->getAllByCustomerId($id, $customer);
    }
}
