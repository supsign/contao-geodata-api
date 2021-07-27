<?php

namespace Supsign\GeoDataApi\Tests;

use Supsign\GeoDataApi\GeoDataApi;
use PHPUnit\Framework\TestCase;

class ContaoGeoDataApiTest extends TestCase
{
    public function testCanBeInstantiated()
    {
        $bundle = new ContaoGeoDataApi();

        $this->assertInstanceOf('Supsign\ContaoGeoDataApi\ContaoAttendanceListBundle', $bundle);
    }
}
