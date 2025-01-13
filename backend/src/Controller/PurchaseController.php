<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PurchaseController extends AbstractController
{
    #[Route('/purchase', name: 'purchase')]
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
        ]);
    }
}
