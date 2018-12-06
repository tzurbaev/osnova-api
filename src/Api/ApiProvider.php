<?php

namespace Osnova\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class ApiProvider
{
    /** @var ClientInterface */
    protected $client;

    /**
     * ApiProvider constructor.
     *
     * @param ClientInterface|null $client
     */
    public function __construct(ClientInterface $client = null)
    {
        $this->client = $client;
    }

    /**
     * Get the HTTP client instance.
     *
     * @return ClientInterface
     */
    public function getClient()
    {
        if (is_null($this->client)) {
            return $this->client = $this->createClient();
        }

        return $this->client;
    }

    /**
     * Set new HTTP client instance.
     *
     * @param ClientInterface $client
     *
     * @return ApiProvider
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Create new HTTP client.
     *
     * @return ClientInterface
     */
    public function createClient()
    {
        return new Client();
    }
}
