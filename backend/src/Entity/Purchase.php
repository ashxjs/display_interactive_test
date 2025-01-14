<?php

namespace App\Entity;

use App\Repository\PurchaseRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PurchaseRepository::class)]
class Purchase implements \JsonSerializable
{

    const CSV_ID = 0;
    const CSV_CUSTOMER_ID = 1;
    const CSV_PRODUCT_ID = 2;
    const CSV_QUANTITY = 3;
    const CSV_PRICE = 4;
    const CSV_CURRENCY = 5;
    const CSV_DATE = 6;

    #[ORM\Id]
    #[ORM\Column(name: 'id', type: Types::STRING, length: 10, unique: true)]
    private string $id;

    #[ORM\ManyToOne(
        targetEntity: Customer::class,
        inversedBy: 'purchases',
        fetch: 'LAZY'
    )]
    #[ORM\JoinColumn(name: 'customer_id', nullable: false, onDelete: 'CASCADE')]
    private ?Customer $customer = null;

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

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'productId' => $this->productId,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'currency' => $this->currency,
            'date' => $this->date->format('Y-m-d'),
            'customer_id' => $this->customer ? $this->customer->getId() : null,
        ];
    }

    // Getters and Setters
    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): self
    {
        $this->customer = $customer;
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

    public static function fromCSV(array $data, Customer $customer): Purchase
    {
        $date = DateTime::createFromFormat('Y-m-d', $data[self::CSV_DATE]);

        $purchase = new Purchase();
        $purchase->setId($data[self::CSV_ID]);
        $purchase->setCustomer($customer);
        $purchase->setProductId($data[self::CSV_PRODUCT_ID]);
        $purchase->setQuantity($data[self::CSV_QUANTITY]);
        $purchase->setPrice($data[self::CSV_PRICE]);
        $purchase->setCurrency($data[self::CSV_CURRENCY]);
        $purchase->setDate($date);

        return $purchase;
    }
}
