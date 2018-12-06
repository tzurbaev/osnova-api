<?php

namespace Osnova;

use GuzzleHttp\Client;
use Osnova\Api\ApiProvider;

abstract class OsnovaResource
{
    /** @var ApiProvider */
    protected $apiProvider;

    /**
     * OsnovaResource constructor.
     *
     * @param ApiProvider $apiProvider
     */
    public function __construct(ApiProvider $apiProvider)
    {
        $this->apiProvider = $apiProvider;
    }

    /**
     * Get the resource domain.
     *
     * @return string
     */
    abstract public static function domain();

    /**
     * Get the original API Provider instance.
     *
     * @return ApiProvider
     */
    public function getApiProvider()
    {
        return $this->apiProvider;
    }

    /**
     * Generate URL for the current resource.
     *
     * @param string $path = '' URL path.
     *
     * @return string
     */
    public function generateUrl(string $path = '')
    {
        return 'https://'.static::domain().($path ? '/'.ltrim($path, '/') : '');
    }

    /**
     * Make new resource instance.
     *
     * @param string $version
     *
     * @return static
     */
    public static function make(string $version)
    {
        return new static(
            new ApiProvider(
                static::makeClient($version)
            )
        );
    }

    /**
     * Make new HTTP client instance.
     *
     * @param string $version
     *
     * @return Client
     */
    protected static function makeClient(string $version)
    {
        return new Client([
            'base_uri' => 'https://api.'.static::domain().'/v'.$version.'/',
            'headers' => [
                'Accept' => 'application/json',
                'User-Agent' => '',
            ],
        ]);
    }
}
