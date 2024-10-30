# PHP Geographic Distance Calculator

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vpro/geo-calculator.svg)](https://packagist.org/packages/vpro/geo-calculator)
[![Tests](https://github.com/vpro/geo-calculator/actions/workflows/tests.yml/badge.svg)](https://github.com/vpro/geo-calculator/actions/workflows/tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/vpro/geo-calculator.svg)](https://packagist.org/packages/vpro/geo-calculator)
[![License](https://img.shields.io/packagist/l/vpro/geo-calculator.svg)](https://packagist.org/packages/vpro/geo-calculator)

A PHP package for calculating geographic distances using the Haversine formula. Perfect for applications needing to determine distances between coordinates or check if locations are within a specific radius.

## Features

- 🌍 Calculate distances between geographic coordinates
- 📏 Support for both kilometers and miles
- 🎯 Check if points are within a given radius
- 🔄 Convert between different distance units
- 💪 Strong typing with PHP 7.4+ support
- 🧪 Comprehensive test suite

## Installation

You can install the package via composer:

```bash
composer require vpro/geo-calculator
```

## Usage

### Basic Distance Calculation

```php
use GeoCalculator\DistanceCalculator;

$calculator = new DistanceCalculator();

// Calculate distance between New York and London
$distance = $calculator->calculateDistance(
    40.7128, -74.0060,  // New York coordinates
    51.5074, -0.1278    // London coordinates
);

echo "Distance: " . round($distance, 2) . " km";
```

### Check if Point is Within Radius

```php
// Check if location is within 100km radius
$isNearby = $calculator->isWithinRadius(
    40.7128, -74.0060,  // Center point
    40.7614, -73.9776,  // Point to check
    100,                // Radius
    'km'                // Unit ('km' or 'mi')
);

if ($isNearby) {
    echo "Location is within radius";
}
```

### Convert Between Units

```php
// Convert 100 kilometers to miles
$miles = $calculator->convertDistance(
    100,    // Distance
    'km',   // From unit
    'mi'    // To unit
);

echo "100 km = " . round($miles, 2) . " miles";
```

## API Reference

### calculateDistance()

Calculate the distance between two geographic points.

```php
public function calculateDistance(
    float $lat1,
    float $lon1,
    float $lat2,
    float $lon2,
    string $unit = 'km'
): float
```

Parameters:
- `$lat1`: Latitude of first point in degrees
- `$lon1`: Longitude of first point in degrees
- `$lat2`: Latitude of second point in degrees
- `$lon2`: Longitude of second point in degrees
- `$unit`: Unit of measurement ('km' or 'mi', defaults to 'km')

### isWithinRadius()

Check if a point is within a specified radius of another point.

```php
public function isWithinRadius(
    float $lat1,
    float $lon1,
    float $lat2,
    float $lon2,
    float $radius,
    string $unit = 'km'
): bool
```

Parameters:
- `$lat1`: Latitude of center point in degrees
- `$lon1`: Longitude of center point in degrees
- `$lat2`: Latitude of point to check in degrees
- `$lon2`: Longitude of point to check in degrees
- `$radius`: Radius to check within
- `$unit`: Unit of measurement ('km' or 'mi', defaults to 'km')

### convertDistance()

Convert distances between different units.

```php
public function convertDistance(
    float $distance,
    string $from,
    string $to
): float
```

Parameters:
- `$distance`: Distance to convert
- `$from`: Original unit ('km' or 'mi')
- `$to`: Target unit ('km' or 'mi')

## Testing

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## Security

If you discover any security-related issues, please email your.email@example.com instead of using the issue tracker.

## Credits

- [V-PRO](https://github.com/Victor070656)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.