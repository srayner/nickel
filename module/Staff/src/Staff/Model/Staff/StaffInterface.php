<?php

namespace Staff\Model\Staff;

interface StaffInterface
{
    public function getStaffId();
    public function setStaffId($staffId);
    public function getFirstName();
    public function setFirstName($firstName);
    public function getLastName();
    public function setLastName($lastName);
    public function getBirthDate();
    public function setBirthDate(\DateTime $birthDate);
    public function getHireDate();
    public function setHireDate(\DateTime $date);
}


