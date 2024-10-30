<?php
namespace GeoCalculator;

class DistanceCalculator
{
    const EARTH_RADIUS_KM = 6371;
    const EARTH_RADIUS_MI = 3959;
    
    /**
     * Calculate the distance between two points using the Haversine formula
     * 
     * @param float $lat1 Latitude of first point in degrees
     * @param float $lon1 Longitude of first point in degrees
     * @param float $lat2 Latitude of second point in degrees
     * @param float $lon2 Longitude of second point in degrees
     * @param string $unit 'km' for kilometers or 'mi' for miles
     * @return float Distance between points in specified unit
     */
    public function calculateDistance(
        float $lat1,
        float $lon1,
        float $lat2,
        float $lon2,
        string $unit = 'km'
    ): float {
        // Convert latitude and longitude to radians
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);
        
        // Calculate differences
        $deltaLat = $lat2 - $lat1;
        $deltaLon = $lon2 - $lon1;
        
        // Haversine formula
        $a = sin($deltaLat / 2) * sin($deltaLat / 2) +
             cos($lat1) * cos($lat2) * 
             sin($deltaLon / 2) * sin($deltaLon / 2);
        
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        
        // Calculate distance using appropriate Earth radius
        $radius = ($unit === 'mi') ? self::EARTH_RADIUS_MI : self::EARTH_RADIUS_KM;
        return $radius * $c;
    }

    /**
     * Check if a point is within a given radius of another point
     * 
     * @param float $lat1 Latitude of center point in degrees
     * @param float $lon1 Longitude of center point in degrees
     * @param float $lat2 Latitude of point to check in degrees
     * @param float $lon2 Longitude of point to check in degrees
     * @param float $radius Radius to check within
     * @param string $unit 'km' for kilometers or 'mi' for miles
     * @return bool True if point is within radius, false otherwise
     */
    public function isWithinRadius(
        float $lat1,
        float $lon1,
        float $lat2,
        float $lon2,
        float $radius,
        string $unit = 'km'
    ): bool {
        $distance = $this->calculateDistance($lat1, $lon1, $lat2, $lon2, $unit);
        return $distance <= $radius;
    }

    /**
     * Convert distance from one unit to another
     * 
     * @param float $distance Distance to convert
     * @param string $from Original unit ('km' or 'mi')
     * @param string $to Target unit ('km' or 'mi')
     * @return float Converted distance
     * @throws \InvalidArgumentException If invalid units specified
     */
    public function convertDistance(
        float $distance,
        string $from,
        string $to
    ): float {
        if ($from === $to) {
            return $distance;
        }
        
        if ($from === 'km' && $to === 'mi') {
            return $distance * 0.621371;
        }
        
        if ($from === 'mi' && $to === 'km') {
            return $distance * 1.60934;
        }
        
        throw new \InvalidArgumentException('Invalid units specified');
    }
}
