# 🌍 Laravel MaxMind
[![Latest Stable Version](http://poser.pugx.org/movemoveapp/laravel-maxmind/v)](https://packagist.org/packages/movemoveapp/laravel-maxmind)
[![Total Downloads](http://poser.pugx.org/movemoveapp/laravel-maxmind/downloads)](https://packagist.org/packages/movemoveapp/laravel-maxmind)
[![Latest Unstable Version](http://poser.pugx.org/movemoveapp/laravel-maxmind/v/unstable)](https://packagist.org/packages/movemoveapp/laravel-maxmind)
[![License](http://poser.pugx.org/movemoveapp/laravel-maxmind/license)](https://packagist.org/packages/movemoveapp/laravel-maxmind)
[![PHP Version Require](http://poser.pugx.org/movemoveapp/laravel-maxmind/require/php)](https://packagist.org/packages/movemoveapp/laravel-maxmind)

**Laravel MaxMind** is a simple and flexible package for accessing [MaxMind GeoIP2](https://maxmind.com/) data passed via Nginx FastCGI parameters.

It allows your Laravel application to read geolocation and ISP information that is resolved by Nginx using the GeoIP2 module, without querying MaxMind databases directly from PHP.

---

## Features

- Automatically parses FastCGI parameters set by Nginx with MaxMind GeoIP2 data
- Supports continent, country, region, city, postal, connection, and ISP data
- Configuration file to override default parameter names
- No need to access MaxMind database from PHP – uses data injected by Nginx

---

## Requirements

- Laravel 10+
- Nginx with `ngx_http_geoip2_module`
- MaxMind `.mmdb` database files
- FastCGI configuration passing GeoIP data to PHP

---

## Installation

```bash
composer require movemoveapp/laravel-maxmind
```

## Register the Service Provider
After installing the package, you need to register the MaxMind service provider.

### Laravel 10 and below

Add the following line to the providers array in your `config/app.php` file:

```php
...
'providers' => [
    // Other providers...
    MoveMoveApp\Maxmind\MaxmindServiceProvider::class,
],

```

### Laravel 11 and above

Register the service provider in the `bootstrap/providers.php` file:

```php
<?php

<?php

return [
    // Other providers...
    MoveMoveApp\Maxmind\MaxmindServiceProvider::class,
];


```

## Publish the Configuration

To publish the configuration file and customize the package settings, run the following Artisan command:

```shell
php artisan vendor:publish --provider='MoveMoveApp\Maxmind\MaxmindServiceProvider'
```

# Configuration

Once published, the configuration file will be available at `config/maxmind.php`.

This file maps MaxMind geolocation headers to internal configuration keys. You may override the defaults using your `.env` file. Below are the available environment variables and their default values:

```php
...
## Maxmind
MAXMIND_ISP_AS_ORGANIZATION=X-ISP-AS-Organization
MAXMIND_ISP_AS=X-ISP-AS
MAXMIND_ISP_ORGANIZATION=X-ISP-Organization
MAXMIND_ISP_NAME=X-ISP-Name
MAXMIND_CONNECTION_TYPE=X-Connection-Type
MAXMIND_POSTAL_CONFIDENCE=X-Postal-Confidence
MAXMIND_POSTAL_CODE=X-Postal-Code
MAXMIND_METRO_CODE=X-Metro-Code
MAXMIND_TIME_ZONE=X-Time-Zone
MAXMIND_LONGITUDE=X-Longitude
MAXMIND_LATITUDE=X-Latitude
MAXMIND_AVERAGE_INCOME=X-Average-Income
MAXMIND_ACCURACY_RADIUS=X-Accuracy-Radius
MAXMIND_CITY_CODE=X-City-Code
MAXMIND_CITY_NAME=X-City-Name
MAXMIND_REGION_CODE=X-Region-Code
MAXMIND_REGION_ISO=X-Region-Iso
MAXMIND_REGION_NAME=X-Region-Name
MAXMIND_COUNTRY_CODE=X-Country-Code
MAXMIND_COUNTRY_ISO=X-Country-Iso
MAXMIND_COUNTRY_NAME=X-Country-Name
MAXMIND_CONTINENT_CODE=X-Continent-Code
MAXMIND_CONTINENT_ISO=X-Continent-Iso
MAXMIND_CONTINENT_NAME=X-Continent-Name

...
```

Each configuration key corresponds to a header (typically set via a reverse proxy or edge server like Nginx). You can override any of these defaults by defining the respective environment variable in your `.env` file.

## Nginx Configuration
To ensure that the MaxMind headers are correctly passed to your Laravel application, you need to configure your Nginx (or other reverse proxy) to forward the appropriate HTTP headers. These headers typically come from services like MaxMind's GeoIP2 or your CDN (e.g., Cloudflare, Fastly, or your own proxy setup).

Below is a sample Nginx configuration that sets the headers based on your upstream data (e.g., using `geoip2` module or an external resolver):

### Step 1: Enable GeoIP2 in `nginx.conf`

You must configure the `ngx_http_geoip2_module` to extract the relevant fields from your MaxMind `.mmdb` files:

```apacheconf
geoip2 /usr/share/GeoIP/GeoIP2-City.mmdb {
    $geoip2_continent_name continent names en;
    $geoip2_continent_iso continent code;
    $geoip2_continent_code continent geoname_id;

    $geoip2_country_name country names en;
    $geoip2_country_iso country iso_code;
    $geoip2_country_code country geoname_id;

    $geoip2_region_name subdivisions names en;
    $geoip2_region_iso subdivisions iso_code;
    $geoip2_region_code subdivisions geoname_id;

    $geoip2_city_name city names en;
    $geoip2_city_code city geoname_id;

    $geoip2_accuracy_radius location accuracy_radius;
    $geoip2_average_income location average_income;
    $geoip2_latitude location latitude;
    $geoip2_longitude location longitude;
    $geoip2_time_zone location time_zone;
    $geoip2_metro_code location metro_code;
    $geoip2_population_density location population_density;
    $geoip2_postal_code postal code;
    $geoip2_postal_confidence postal confidence;
}

geoip2 /usr/share/GeoIP/GeoIP2-Connection-Type.mmdb {
    $geoip2_connection_type connection_type;
}

geoip2 /usr/share/GeoIP/GeoIP2-ISP.mmdb {
    $geoip2_isp_name isp;
    $geoip2_isp_organization organization;
    $geoip2_as autonomous_system_number;
    $geoip2_as_organization autonomous_system_organization;
}

```

### Step 2: Pass GeoIP2 Data via `fastcgi_param`

In your site configuration (typically under `sites-available/your-site.conf`), include the following `fastcgi_param` directives in the `location ~ \.php$` block to pass GeoIP2 values to PHP:

```apacheconf
fastcgi_param X-Continent-Name         $geoip2_continent_name;
fastcgi_param X-Continent-Iso          $geoip2_continent_iso;
fastcgi_param X-Continent-Code         $geoip2_continent_code;

fastcgi_param X-Country-Name           $geoip2_country_name;
fastcgi_param X-Country-Iso            $geoip2_country_iso;
fastcgi_param X-Country-Code           $geoip2_country_code;

fastcgi_param X-Region-Name            $geoip2_region_name;
fastcgi_param X-Region-Iso             $geoip2_region_iso;
fastcgi_param X-Region-Code            $geoip2_region_code;

fastcgi_param X-City-Name              $geoip2_city_name;
fastcgi_param X-City-Code              $geoip2_city_code;

fastcgi_param X-Accuracy-Radius        $geoip2_accuracy_radius;
fastcgi_param X-Average-Income         $geoip2_average_income;
fastcgi_param X-Latitude               $geoip2_latitude;
fastcgi_param X-Longitude              $geoip2_longitude;
fastcgi_param X-Time-Zone              $geoip2_time_zone;
fastcgi_param X-Metro-Code             $geoip2_metro_code;
fastcgi_param X-Postal-Density         $geoip2_population_density;
fastcgi_param X-Postal-Code            $geoip2_postal_code;
fastcgi_param X-Postal-Confidence      $geoip2_postal_confidence;

fastcgi_param X-Connection-Type        $geoip2_connection_type;

fastcgi_param X-ISP-Name               $geoip2_isp_name;
fastcgi_param X-ISP-Organization       $geoip2_isp_organization;
fastcgi_param X-ISP-AS-Number          $geoip2_as;
fastcgi_param X-ISP-AS-Organization    $geoip2_as_organization;

```

⚠️ These parameters will be available in Laravel using $request->server('HTTP_X_CONTINENT_NAME'), etc. The package automatically maps them internally — you don't need to manually extract them in your controller.

### Verifying Integration

To verify that your headers are being received:

1. Run php artisan `route:clear` to refresh routing cache.
2. Create a debug route:

```php
Route::get('/debug-geo', function (\Illuminate\Http\Request $request) {
    return request()->server();
});

```

3. Access `/debug-geo` in your browser and check for `HTTP_X_CONTINENT_NAME`, `HTTP_X_COUNTRY_NAME`, etc.
