<?php

namespace kinoheld\GeoDistance;

class GeoDistance
{

	const EARTH_RADIUS_KILOMETERS = 6371;

	/**
	 * Calculate distance in kilometers.
	 *
	 * @param float $sourceLatitude
	 * @param float $sourceLongitude
	 * @param float $destinationLatitude
	 * @param float $destinationLongitude
	 * @return float
	 */
	public static function calculateDistance(float $sourceLatitude, float $sourceLongitude, float $destinationLatitude, float $destinationLongitude)
	{
		return ( self::EARTH_RADIUS_KILOMETERS * acos( cos( deg2rad( $sourceLatitude ) ) * cos( deg2rad( $destinationLatitude ) ) * cos( deg2rad( $destinationLongitude ) - deg2rad( $sourceLongitude ) ) + sin( deg2rad( $sourceLatitude ) ) * sin( deg2rad( $destinationLatitude ) ) ) );
	}

	/**
	 * Get distance query for SQL query.
	 *
	 * @param string $dbFieldLatitude
	 * @param string $dbFieldLongitude
	 * @param string $paramLatitude
	 * @param string $paramLongitude
	 * @return string
	 */
	public static function buildDistanceSQL(string $dbFieldLatitude = 'latitude', string $dbFieldLongitude = 'longitude', string $paramLatitude = ':latitude', string $paramLongitude = ':longitude')
	{
		return sprintf('( %s * ACOS( COS( RADIANS( %s ) ) * COS( RADIANS( %s ) ) * COS( RADIANS( %s ) - RADIANS( %s ) ) + SIN( RADIANS( %s ) ) * SIN( RADIANS( %s ) ) ) )', self::EARTH_RADIUS_KILOMETERS, $paramLatitude, $dbFieldLatitude, $dbFieldLongitude, $paramLongitude, $paramLatitude, $dbFieldLatitude);
	}

}
