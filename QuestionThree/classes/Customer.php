<?php

class Customer
{
    protected string $first_name;

    protected string $last_name;

    public array $addresses;


    /**
     * @param string $first_name
     * @param string $last_name
     * @param array $addresses
     */
    public function __construct(string $first_name, string $last_name, array $addresses)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->addresses = $addresses;
    }

    public function getName(): string
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    public function getAddresses(): array
    {
        return $this->addresses;
    }

    public function setAddresses(array $addresses): void
    {
        $this->addresses = $addresses;
    }
}