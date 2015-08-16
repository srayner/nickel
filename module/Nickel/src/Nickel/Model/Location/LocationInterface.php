<?php

namespace Nickel\Model\Location;

interface LocationInterface
{
    public function getLocationId();
    public function setLocationID($locationId);
    public function getOrganisationName();
    public function setOrganisationName($organisationName);
    public function getAddressLine1();
    public function setAddressLine1($addressLine1);
    public function getAddressLine2();
    public function setAddressLine2($addressLine2);
    public function getPostTown();
    public function setPostTown($postTown);
    public function getCounty();
    public function setCounty($county);
    public function getPostCode();
    public function setPostCode($postCode);
    public function getCustomerId();
    public function setCustomerId($customerId);
    public function getFullAddress($seperator);
}