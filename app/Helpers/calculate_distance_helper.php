<?php

function calculateInMettersDistanceBetweenLatitudeAndLongitude(
    float|int|string $latitude1,
    float|int|string $longitude1,
    float|int|string $latitude2,
    float|int|string $longitude2
): float
{
    if (
        !is_numeric($latitude1) ||
        !is_numeric($latitude2) ||
        !is_numeric($longitude1) ||
        !is_numeric($longitude2)
    ) {
        return 0;
    }

    $latitude1 = deg2rad($latitude1);
    $longitude1 = deg2rad($longitude1);
    $latitude2 = deg2rad($latitude2);
    $longitude2 = deg2rad($longitude2);

    $latitudeDistance = $latitude2 - $latitude1;
    $longitudeDistance = $longitude2 - $longitude1;

    $distance = 2 * asin(sqrt(pow(sin($latitudeDistance / 2), 2) +
            cos($latitude1) * cos($latitude2) * pow(sin($longitudeDistance / 2), 2)));

    $distance = $distance * 6371;

    return (float)number_format($distance * 1000, 2, '.', '');
}

function validateLatitude(float $latitude): bool
{
    $lat_array = explode('.', $latitude);

    if (sizeof($lat_array) != 2) {
        return false;
    }

    if (!(is_numeric($lat_array[0]) && $lat_array[0] == round($lat_array[0], 0) && is_numeric($lat_array[1]) && $lat_array[1] == round($lat_array[1], 0))) {
        return false;
    }

    if ($latitude >= -90 && $latitude <= 90) {
        return true;
    } else {
        return false;
    }
}

function validateLongitude(float $longitude): bool
{
    $long_array = explode('.', $longitude);

    if (sizeof($long_array) != 2) {
        return false;
    }

    if (!(is_numeric($long_array[0]) && $long_array[0] == round($long_array[0], 0) && is_numeric($long_array[1]) && $long_array[1] == round($long_array[1], 0))) {
        return false;
    }

    if ($longitude >= -180 && $longitude <= 180) {
        return true;
    } else {
        return false;
    }
}
