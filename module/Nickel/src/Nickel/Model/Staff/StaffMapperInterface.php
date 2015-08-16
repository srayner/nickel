<?php

namespace Nickel\Model\Staff;

interface StaffMapperInterface
{
    public function getStaff();
    public function getStaffById($staffId);
    public function getActiveStaff();
    public function deleteStaffById($staffId);
    public function persist(StaffInterface $staff);
    public function persistAvatar($staffId, $tmpFile);
    public function countStaff();
}
