<?php

namespace Nickel\Model\Location;

interface LocationMapperInterface
{
    public function getLocations();
    public function getLocationById($locationId);
    public function getLocationsByCustomerId($customerId);
    public function deleteLocationById($locationId);
    public function persist(LocationInterface $location);
    public function countLocations();
}
