<?php
require_once "./classes/Address.php";
require_once "./classes/Cart.php";
require_once "./classes/Customer.php";
require_once "./classes/Item.php";
require_once "./lib/ApiCaller.php";

// Customer addresses
$office_address = new Address(
    line_1: "Cr 59A # 55-30",
    line_2: "",
    city: "Medellin",
    state: "Antioquia",
    zip: "050001"
);

$home_address = new Address(
    line_1: "Cr 12A # 61-27",
    line_2: "",
    city: "Medellin",
    state: "Antioquia",
    zip: "050006"
);

// Create customer
$customer = new Customer(
    first_name: "Daniel",
    last_name: "Urrego Zapata",
    addresses: [$office_address, $home_address]
);

// Create items
$milk = new Item(
    id: 123,
    name: "Milk",
    quantity: 1,
    price: 2
);

$cereal = new Item(
    id: 228,
    name: "Cereal",
    quantity: 2,
    price: 4
);

// Create cart
$apiCaller = new ApiCaller(); // Dependency

$cart = new Cart($customer, $apiCaller);
$cart->addItem($milk);
$cart->addItem($cereal);


// - Customer Name:
$customer_name = $customer->getName();
echo "\033[34mCustomer Name:\033[0m \033[31m". $customer_name . "\033[0m\n";

// - Customer Addresses:
$addresses = $customer->addresses;
foreach ($addresses as $address) {
    echo "\033[36m Customer Address:\033[0m\n";
     print_r($address);
}

// - Items in Cart
$items = $cart->items;
foreach ($items as $item) {
    echo "\033[35m Item in cart:\033[0m\n";
    print_r($item);
}

// - Where Order Ships
$shipping_address  = $cart->customer->addresses[0];
echo "\033[33mShipping address:\033[0m \033[31m". $shipping_address->getLine1() . "\033[0m\n";

// - Cost of item in cart, including shipping and tax
$cost = $cart->calculateItemCost($cereal);
echo "\033[32mCost of {$cereal->getName()}:\033[0m \033[31m". $cost . "\033[0m\n";

//- Subtotal and total and for all items
$subtotal_all_items = $cart->subtotalAllItems();
echo "\033[36mSubtotal for all items :\033[0m \033[35m". $subtotal_all_items . "\033[0m\n";

$total_all_items = $cart->totalAllItems();
echo "\033[35mTotal for all items :\033[0m \033[36m". $total_all_items . "\033[0m\n";