<?php

namespace Supsign\AttendanceListBundle\Tests;

use Supsign\AttendanceListBundle\AttendanceListBundle;
use PHPUnit\Framework\TestCase;

class ContaoAttendanceListBundleTest extends TestCase
{
    public function testCanBeInstantiated()
    {
        $bundle = new ContaoAttendanceListBundle();

        $this->assertInstanceOf('Supsign\ContaoAttendanceListBundle\ContaoAttendanceListBundle', $bundle);
    }
}
