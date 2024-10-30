<?php

namespace GeoCalculator\Tests;

use GeoCalculator\DistanceCalculator;
use PHPUnit\Framework\TestCase;

class DistanceCalculatorTest extends TestCase
{
    private DistanceCalculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new DistanceCalculator();
    }

    public function testCalculateDistance(): void
    {
        // New York to London approximate coordinates
        $distance = $this->calculator->calculateDistance(
            40.7128,
            -74.0060,
            51.5074,
            -0.1278
        );

        // Approximate distance should be around 5570 km
        $this->assertGreaterThan(5500, $distance);
        $this->assertLessThan(5600, $distance);
    }

    public function testIsWithinRadius(): void
    {
        // Two points in Manhattan
        $isNearby = $this->calculator->isWithinRadius(
            40.7128,
            -74.0060,
            40.7614,
            -73.9776,
            10,
            'km'
        );

        $this->assertTrue($isNearby);
    }

    public function testDistanceConversion(): void
    {
        $kilometers = 100;
        $miles = $this->calculator->convertDistance($kilometers, 'km', 'mi');

        $this->assertEqualsWithDelta(62.1371, $miles, 0.0001);
    }
}
