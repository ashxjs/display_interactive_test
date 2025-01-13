<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{
    #[ORM\Id]
    #[ORM\Column(name: 'customer_id', type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    private int $customerId;

    #[ORM\Column(name: 'title', type: Types::SMALLINT, nullable: true)]
    private ?int $title;

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

    // Getters and Setters
    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function getTitle(): ?int
    {
        return $this->title;
    }

    public function setTitle(?int $title): self
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
}
