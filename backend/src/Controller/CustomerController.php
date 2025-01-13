<?php

namespace App\Controller;

use App\Services\CustomerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    private CustomerService $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    #[Route('/customers', name: 'customer')]
    public function getCustomers()
    {
        $customers = $this->customerService->getCustomers();

        return $this->json($customers);
    }
}
