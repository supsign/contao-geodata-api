<?php

namespace Supsign\ContaoAttendanceListBundle\Repository;

use Doctrine\ORM\EntityRepository;

class AttendanceListRepository extends EntityRepository
{
    public function findAll(array $orderBy = [])
    {
        return $this->findBy([], $orderBy);
    }
}