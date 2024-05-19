<?php

function calculateInMettersDistanceBetweenLatitudeAndLongitude(
    float|int|string $latitude1,
    float|int|string $longitude1,
    float|int|string $latitude2,
    float|int|string $longitude2
): float
{
    if(
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
