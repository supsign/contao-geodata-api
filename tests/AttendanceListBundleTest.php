<?php

/*
 * This file is part of [package name].
 *
 * (c) John Doe
 *
 * @license LGPL-3.0-or-later
 */

namespace Supsign\SkeletonBundle\Tests;

use Supsign\AttendanceListBundle\AttendanceListBundle;
use PHPUnit\Framework\TestCase;

class AttendanceListBundleTest extends TestCase
{
    public function testCanBeInstantiated()
    {
        $bundle = new AttendanceListBundle();

        $this->assertInstanceOf('Supsign\AttendanceListBundle\AttendanceListBundle', $bundle);
    }
}
