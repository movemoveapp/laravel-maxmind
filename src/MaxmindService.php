<?php

namespace MoveMoveApp\Maxmind;

use MoveMoveApp\Maxmind\Enums\NetworkType;

class MaxmindService
{
    protected array $headers;

    /**
     * @param array $headers
     */
    public function __construct(array $headers = [])
    {
        $this->headers = $headers ?: $_SERVER;
    }

    /**
     * ISP AS Organization
     *
     * @return string|null
     */
    public function ispAsOrganization(): ?string
    {
        return $this->get('isp_as_organization');
    }

    /**
     * ISP AS
     *
     * @return string|null
     */
    public function ispAs(): ?string
    {
        return $this->get('isp_as');
    }

    /**
     * ISP Organization
     *
     * @return string|null
     */
    public function ispOrganization(): ?string
    {
        return $this->get('isp_organization');
    }

    /**
     * ISP name
     *
     * @return string|null
     */
    public function ispName(): ?string
    {
        return $this->get('isp_name');
    }

    /**
     * Connection type
     *
     * @return string|null
     */
    public function connectionType(): ?string
    {
        return $this->get('connection_type');
    }

    /**
     * Postal confidence
     *
     * @return string|null
     */
    public function postalConfidence(): ?string
    {
        return $this->get('postal_confidence');
    }

    /**
     * Postal code
     *
     * @return string|null
     */
    public function postalCode(): ?string
    {
        return $this->get('postal_code');
    }

    /**
     * Metro code
     *
     * @return string|null
     */
    public function metroCode(): ?string
    {
        return $this->get('metro_code');
    }

    /**
     * Time zone
     *
     * @return string|null
     */
    public function timeZone(): ?string
    {
        return $this->get('time_zone');
    }

    /**
     * GEO longitude
     *
     * @return string|null
     */
    public function longitude(): ?string
    {
        return $this->get('longitude');
    }

    /**
     * GEO latitude
     *
     * @return string|null
     */
    public function latitude(): ?string
    {
        return $this->get('latitude');
    }

    /**
     * Average income
     *
     * @return string|null
     */
    public function averageIncome(): ?string
    {
        return $this->get('average_income');
    }

    /**
     * Accuracy radius
     *
     * @return string|null
     */
    public function accuracyRadius(): ?string
    {
        return $this->get('accuracy_radius');
    }

    /**
     * City code
     *
     * @return string|null
     */
    public function cityCode(): ?string
    {
        return $this->get('city_code');
    }

    /**
     * City name
     *
     * @return string|null
     */
    public function cityName(): ?string
    {
        return $this->get('city_name');
    }

    /**
     * Region code
     *
     * @return string|null
     */
    public function regionCode(): ?string
    {
        return $this->get('region_code');
    }

    /**
     * Region ISO
     *
     * @return string|null
     */
    public function regionIso(): ?string
    {
        return $this->get('region_iso');
    }

    /**
     * Region name
     *
     * @return string|null
     */
    public function regionName(): ?string
    {
        return $this->get('region_name');
    }

    /**
     * Country code
     *
     * @return string|null
     */
    public function countryCode(): ?string
    {
        return $this->get('country_code');
    }

    /**
     * Country ISO
     *
     * @return string|null
     */
    public function countryIso(): ?string
    {
        return $this->get('country_iso');
    }

    /**
     * Country name
     *
     * @return string|null
     */
    public function countryName(): ?string
    {
        return $this->get('country_name');
    }

    /**
     * Continent code
     *
     * @return string|null
     */
    public function continentCode(): ?string
    {
        return $this->get('continent_code');
    }

    /**
     * Continent ISO
     *
     * @return string|null
     */
    public function continentIso(): ?string
    {
        return $this->get('continent_iso');
    }

    /**
     * Continent name
     *
     * @return string|null
     */
    public function continentName(): ?string
    {
        return $this->get('continent_name');
    }

    /**
     * Detect the type of an IP address.
     *
     * This method checks whether the given IP address is a valid IPv4 or IPv6 address.
     * If the IP is not valid, it will return NetworkType::INVALID.
     *
     * @param string $ip
     * @return NetworkType
     */
    function detectIpType(string $ip): NetworkType
    {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return NetworkType::IPV4;
        }

        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return NetworkType::IPV6;
        }

        return NetworkType::INVALID;
    }

    /**
     * @param string|null $key
     * @return string|null
     */
    protected static function get(?string $key): ?string
    {
        if (!$key) {
            return null;
        }

        if (isset($_SERVER[$key])) {
            return $_SERVER[$key];
        }

        $httpKey = 'HTTP_' . strtoupper(str_replace('-', '_', $key));
        return $_SERVER[$httpKey] ?? null;
    }

}
