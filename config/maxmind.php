<?php

return [
    /*
    |--------------------------------------------------------------------------
    | MaxMind Header Mapping
    |--------------------------------------------------------------------------
    |
    | These keys define which FastCGI parameters (usually passed from Nginx)
    | should be used to retrieve the corresponding MaxMind GeoIP2 data.
    | You can override these defaults using environment variables.
    */

    /*
    |--------------------------------------------------------------------------
    | ISP & Connection Type
    |--------------------------------------------------------------------------
    | - isp_as_organization: Name of the organization associated with the autonomous system
    | - isp_as: AS (Autonomous System) number
    | - isp_organization: Organization providing the IP address
    | - isp_name: ISP name associated with the IP
    | - connection_type: Connection type (e.g., Cable/DSL, Cellular, etc.)
    */
    'isp_as_organization'   => env('MAXMIND_ISP_AS_ORGANIZATION', 'X-ISP-AS-Organization'),

    'isp_as'                => env('MAXMIND_ISP_AS', 'X-ISP-AS'),

    'isp_organization'      => env('MAXMIND_ISP_ORGANIZATION', 'X-ISP-Organization'),

    'isp_name'              => env('MAXMIND_ISP_NAME', 'X-ISP-Name'),

    'connection_type'       => env('MAXMIND_CONNECTION_TYPE', 'X-Connection-Type'),


    /*
    |--------------------------------------------------------------------------
    | Location Precision
    |--------------------------------------------------------------------------
    | - postal_confidence: Confidence level in the postal code accuracy
    | - postal_code: ZIP or postal code
    | - metro_code: Metro area code (mostly US)
    | - time_zone: Time zone associated with the IP
    | - longitude, latitude: Approximate geo-coordinates of the user
    | - average_income: Average income in the user's area (if available)
    | - accuracy_radius: Estimated radius in kilometers around the user's
    |   location
    */
    'postal_confidence'     => env('MAXMIND_POSTAL_CONFIDENCE', 'X-Postal-Confidence'),

    'postal_code'           => env('MAXMIND_POSTAL_CODE', 'X-Postal-Code'),

    'metro_code'            => env('MAXMIND_METRO_CODE', 'X-Metro-Code'),

    'time_zone'             => env('MAXMIND_TIME_ZONE', 'X-Time-Zone'),

    'longitude'             => env('MAXMIND_LONGITUDE', 'X-Longitude'),

    'latitude'              => env('MAXMIND_LATITUDE', 'X-Latitude'),

    'average_income'        => env('MAXMIND_AVERAGE_INCOME', 'X-Average-Income'),

    'accuracy_radius'       => env('MAXMIND_ACCURACY_RADIUS', 'X-Accuracy-Radius'),

    /*
    |--------------------------------------------------------------------------
    | City & Region
    |--------------------------------------------------------------------------
    | - city_code: Internal or provider-specific city code
    | - city_name: Name of the city
    | - region_code: Subdivision code (e.g., California = CA)
    | - region_iso: ISO code of the region
    | - region_name: Full name of the region
    */
    'city_code'             => env('MAXMIND_CITY_CODE', 'X-City-Code'),

    'city_name'             => env('MAXMIND_CITY_NAME', 'X-City-Name'),

    'region_code'           => env('MAXMIND_REGION_CODE', 'X-Region-Code'),

    'region_iso'            => env('MAXMIND_REGION_ISO', 'X-Region-Iso'),

    'region_name'           => env('MAXMIND_REGION_NAME', 'X-Region-Name'),

    /*
    |--------------------------------------------------------------------------
    | Country & Continent
    |--------------------------------------------------------------------------
    | - country_code: Country code (e.g., US)
    | - country_iso: ISO 3166-1 alpha-2 country code
    | - country_name: Country name
    | - continent_code: Continent code (e.g., NA)
    | - continent_iso: ISO code of the continent
    | - continent_name: Name of the continent
    |
    */
    'country_code'          => env('MAXMIND_COUNTRY_CODE', 'X-Country-Code'),

    'country_iso'           => env('MAXMIND_COUNTRY_ISO', 'X-Country-Iso'),

    'country_name'          => env('MAXMIND_COUNTRY_NAME', 'X-Country-Name'),

    'continent_code'        => env('MAXMIND_CONTINENT_CODE', 'X-Continent-Code'),

    'continent_iso'         => env('MAXMIND_CONTINENT_ISO', 'X-Continent-Iso'),

    'continent_name'        => env('MAXMIND_CONTINENT_NAME', 'X-Continent-Name'),

];
