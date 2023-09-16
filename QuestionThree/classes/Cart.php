<?php

class Cart
{
    public Customer $customer;
    public array $items;

    private $apiCaller;

    /**
     * @param Customer $customer
     * @param  $apiCaller
     */
    public function __construct(Customer $customer, $apiCaller)
    {
        $this->customer = $customer;
        $this->apiCaller = $apiCaller;
        $this->items = [];
    }

    public function addItem($item): void
    {
        $this->items[] = $item;
    }

    private function calculateShipping(): float
    {
        $shipping = 0;
        try {
            $response = $this->apiCaller->callApi("Endpoint", "Method", ["data" => []]);
            if ($response["shipping"]) {
                $shipping = $response["shipping"];
            }

            return $shipping;

        } catch (Throwable $e) {
            echo "Error: " . $e->getMessage();
            return $shipping;
        }
    }

    private function calculateTax(float $subtotal): float
    {
        return $subtotal * 0.07;
    }

    private function calculateSubtotal(Item $item): float
    {
        return $item->getPrice() * $item->getQuantity();
    }

    public function calculateItemCost(Item $item): float
    {
        if (empty($this->items) && in_array($item, $this->items)) {
            return 0;
        }

        $subtotal = $this->calculateSubtotal($item);
        $tax = $this->calculateTax($subtotal);
        $shipping = $this->calculateShipping();
        return $subtotal + $tax + $shipping;
    }

    public function subtotalAllItems(): float
    {
        if (empty($this->items)) {
            return 0;
        }

        $subtotal = 0;
        foreach ($this->items as $item) {
            $subtotal += $this->calculateSubtotal($item);
        }

        return $subtotal;
    }

    public function totalAllItems(): float
    {
        if (empty($this->items)) {
            return 0;
        }

        $subtotal = $this->subtotalAllItems();
        $tax = $this->calculateTax($subtotal);
        $shipping = $this->calculateShipping();

        return $subtotal + $tax + $shipping;
    }
}