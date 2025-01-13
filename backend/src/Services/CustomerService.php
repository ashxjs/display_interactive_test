<?php

namespace App\Services;

use App\Repository\CustomerRepository;

class CustomerService
{
    private CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getCustomers(): array
    {
        return $this->customerRepository->findAll();
    }
}
