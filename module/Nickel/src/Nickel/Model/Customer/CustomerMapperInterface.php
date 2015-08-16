<?php

namespace Nickel\Model\Customer;

interface CustomerMapperInterface
{
    public function getCustomers();
    public function getCustomerById($customerId);
    public function deleteCustomerById($customerId);
    public function persist(CustomerInterface $customer);
    public function countCustomers();
}
