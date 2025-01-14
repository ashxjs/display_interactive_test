<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer implements \JsonSerializable
{

    const CSV_ID = 0;
    const CSV_TITLE = 1;
    const CSV_LASTNAME = 2;
    const CSV_FIRSTNAME = 3;
    const CSV_POSTAL_CODE = 4;
    const CSV_CITY = 5;
    const CSV_EMAIL = 6;

    #[ORM\Id]
    #[ORM\Column(name: 'id', type: Types::INTEGER, unique: true)]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(name: 'title', type: Types::STRING, length: 3, nullable: true)]
    private ?string $title;

    #[ORM\Column(name: 'lastname', type: Types::STRING, length: 255, nullable: true)]
    private ?string $lastname;

    #[ORM\Column(name: 'firstname', type: Types::STRING, length: 255, nullable: true)]
    private ?string $firstname;

    #[ORM\Column(name: 'postal_code', type: Types::STRING, length: 10, nullable: true)]
    private ?string $postalCode;

    #[ORM\Column(name: 'city', type: Types::STRING, length: 255, nullable: true)]
    private ?string $city;

    #[ORM\Column(name: 'email', type: Types::STRING, length: 255, nullable: true)]
    private ?string $email;

    #[ORM\OneToMany(
        targetEntity: Purchase::class,
        mappedBy: 'customer',
        cascade: ['persist'],
        fetch: 'LAZY'
    )]
    private Collection $purchases;

    public function __construct()
    {
        $this->purchases = new ArrayCollection();
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'lastname' => $this->lastname,
            'firstname' => $this->firstname,
            'postalCode' => $this->postalCode,
            'city' => $this->city,
            'email' => $this->email,
        ];
    }

    // Getters and Setters
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getPurchases(): Collection
    {
        return $this->purchases;
    }

    public function addPurchase(Purchase $purchase): self
    {
        if (!$this->purchases->contains($purchase)) {
            $this->purchases[] = $purchase;
            $purchase->setCustomer($this);
        }

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public static function fromCSV(array $data): Customer
    {
        $title = $data[self::CSV_TITLE] === strval(1) ? "Mme" : "M";
        $customer = new Customer();
        $customer->setId($data[self::CSV_ID]);
        $customer->setTitle($title);
        $customer->setLastname($data[self::CSV_LASTNAME] ?? "");
        $customer->setFirstname($data[self::CSV_FIRSTNAME] ?? "");
        $customer->setPostalCode($data[self::CSV_POSTAL_CODE] ?? "");
        $customer->setCity($data[self::CSV_CITY] ?? "");
        $customer->setEmail($data[self::CSV_EMAIL] ?? "");

        return $customer;
    }
}
