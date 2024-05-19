<?php

namespace Tests\Unit;

use Tests\TestCase;

class CalculateDistanceTest extends TestCase
{
    private static array $localization = [
        "latitude" => -27.6743241,
        "longitude" => -48.6829177,
    ];

    private static array $localizationLessThanTenMeters = [
        "latitude" => -27.6743210,
        "longitude" => -48.6829110,
    ];

    private static array $localizationBiggerThanTenMeters = [
        "latitude" => -27.6749494,
        "longitude" => -48.680398,
    ];

    private static array $localizationWithInvalidParameters = [
        "latitude" => "invalid argument",
        "longitude" => -48.6818246,
    ];

    public function test_passing_invalid_parameters()
    {
        $distance = calculateInMettersDistanceBetweenLatitudeAndLongitude(
            self::$localizationWithInvalidParameters["latitude"],
            self::$localizationWithInvalidParameters["longitude"],
            self::$localization["latitude"],
            self::$localization["longitude"],
        );

        $this->assertEquals(0, $distance);
    }

    public function test_distance_longer_than_ten_meters()
    {
        $distance = calculateInMettersDistanceBetweenLatitudeAndLongitude(
            self::$localization["latitude"],
            self::$localization["longitude"],
            self::$localizationBiggerThanTenMeters["latitude"],
            self::$localizationBiggerThanTenMeters["longitude"],
        );

        $this->assertTrue($distance > 10);
    }

    public function test_distance_less_than_ten_meters()
    {
        $distance = calculateInMettersDistanceBetweenLatitudeAndLongitude(
            self::$localization["latitude"],
            self::$localization["longitude"],
            self::$localizationLessThanTenMeters["latitude"],
            self::$localizationLessThanTenMeters["longitude"],
        );

        $this->assertTrue($distance < 10);
    }
}
