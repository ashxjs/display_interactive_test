<?php

namespace App\Controller;

use App\Services\CustomerService;
use App\Services\PurchaseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    private CustomerService $customerService;
    private PurchaseService $purchaseService;

    public function __construct(CustomerService $customerService, PurchaseService $purchaseService)
    {
        $this->customerService = $customerService;
        $this->purchaseService = $purchaseService;
    }

    #[Route('/customers', name: 'customer')]
    public function getCustomers()
    {
        $customers = $this->customerService->getCustomers();
        return $this->json($customers);
    }

    #[Route('/customers/{id}/orders', name: 'customer_id_orders')]
    public function getCustomerOrders(int $id)
    {
        $customer = $this->customerService->findById($id);
        $orders = $this->purchaseService->getAllByCustomerId($id, $customer);

        return $this->json($orders);
    }
}
