<?php

function calculateInMettersDistanceBetweenLatitudeAndLongitude(
    float $latitude1,
    float $longitude1,
    float $latitude2,
    float $longitude2
): float
{
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
