<?php

namespace Supsign\ContaoGeoDataApiBundle\Repository;

use Doctrine\ORM\EntityRepository;

class GeoDataApiRepositry extends EntityRepository
{
    public function findAll(array $orderBy = [])
    {
        return $this->findBy([], $orderBy);
    }
}