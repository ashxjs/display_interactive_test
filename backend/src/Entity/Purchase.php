<?php

namespace App\Entity;

use App\Repository\PurchaseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PurchaseRepository::class)]
class Purchase
{
    #[ORM\Id]
    #[ORM\Column(name: 'purchase_identifier', type: Types::STRING, length: 10)]
    private string $purchaseIdentifier;

    #[ORM\Column(name: 'customer_id', type: Types::INTEGER)]
    private int $customerId;

    #[ORM\Column(name: 'product_id', type: Types::INTEGER)]
    private int $productId;

    #[ORM\Column(name: 'quantity', type: Types::INTEGER)]
    private int $quantity;

    #[ORM\Column(name: 'price', type: Types::FLOAT, precision: 10, scale: 2)]
    private float $price;

    #[ORM\Column(name: 'currency', type: Types::STRING, length: 10)]
    private string $currency;

    #[ORM\Column(name: 'date', type: 'date')]
    private \DateTime $date;

    // Getters and Setters
    public function getPurchaseIdentifier(): string
    {
        return $this->purchaseIdentifier;
    }

    public function setPurchaseIdentifier(string $purchaseIdentifier): self
    {
        $this->purchaseIdentifier = $purchaseIdentifier;
        return $this;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function setCustomerId(int $customerId): self
    {
        $this->customerId = $customerId;
        return $this;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): self
    {
        $this->productId = $productId;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): self
    {
        $this->date = $date;
        return $this;
    }
}
