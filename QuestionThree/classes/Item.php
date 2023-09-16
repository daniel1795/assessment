<?php

class Item
{
    protected int $id;

    protected string $name;

    protected int $quantity;

    protected float $price;

    /**
     * @param int $id
     * @param string $name
     * @param int $quantity
     * @param float $price
     */
    public function __construct(int $id, string $name, int $quantity, float $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}