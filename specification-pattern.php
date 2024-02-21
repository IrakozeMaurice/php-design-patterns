<?php
require 'functions.php';

class CustomerIsGold
{
    public function isSatisfiedBy(Customer $customer)
    {
        return $customer->type() === 'gold';
    }
}

class Customer
{
    protected $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function type()
    {
        return $this->type;
    }
}

class CustomerRepository
{
    protected array $customers;

    public function __construct($customers)
    {
        $this->customers = $customers;
    }

    public function matchingSpecification($specification)
    {
        $matches = [];

        foreach ($this->customers as $customer) {

            if ($specification->isSatisfiedBy($customer)) {
                $matches[] = $customer;
            }
        }
        return $matches;
    }
}

$customers = new CustomerRepository([
    new Customer('gold'),
    new Customer('silver'),
    new Customer('bronze'),
    new Customer('gold'),
]);

$specification = new CustomerIsGold;

$gold_customers = $customers->matchingSpecification($specification);

dd(count($gold_customers));
