<?php

namespace Nickel\Model\Customer;

interface CustomerInterface
{
    public function getCustomerId();
    public function setCustomerId($customerId);
    public function getCompanyName();
    public function setCompanyName($companyName);
    public function getPhoneNo();
    public function setPhoneNo($phoneNo);
    public function getFaxNo();
    public function setFaxNo($faxNo);
    public function getEmailAddress();
    public function setEmailAddress($emailAddress);
}