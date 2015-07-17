<?php

namespace Staff\Model\Staff;

interface StaffMapperInterface
{
    public function getStaff();
    public function getStaffById($staffId);
    public function deleteStaffById($staffId);
    public function persist(StaffInterface $staff);
}
