<?php

namespace Nickel\Model\Staff;

interface StaffInterface
{
    public function getStaffId();
    public function setStaffId($staffId);
    public function getFirstName();
    public function setFirstName($firstName);
    public function getLastName();
    public function setLastName($lastName);
    public function getFullName();
    public function getBirthDate();
    public function setBirthDate(\DateTime $birthDate);
    public function getHireDate();
    public function setHireDate(\DateTime $date);
    public function getJobTitle();
    public function setJobTitle($jobTitle);
    public function getActive();
    public function setActive($active);
    public function avatar();
}


