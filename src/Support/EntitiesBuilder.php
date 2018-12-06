<?php

namespace Osnova\Support;

use Osnova\Api\ApiProvider;
use Osnova\OsnovaResource;
use Psr\Http\Message\ResponseInterface;

class EntitiesBuilder
{
    protected $class;
    protected $data = [];
    protected $apiProvider;
    protected $resource;

    public function __construct(string $class)
    {
        $this->class = $class;
    }

    public static function make(string $class)
    {
        return new static($class);
    }

    public function from(array $data)
    {
        $this->data = $data;

        return $this;
    }

    public function fromResponse(ResponseInterface $response)
    {
        $this->data = json_decode((string) $response->getBody(), true)['result'] ?? [];

        return $this;
    }

    public function with(ApiProvider $apiProvider = null, OsnovaResource $resource = null)
    {
        return $this->withApiProvider($apiProvider)
            ->withOsnovaResource($resource);
    }

    public function withApiProvider(ApiProvider $apiProvider = null)
    {
        $this->apiProvider = $apiProvider;

        return $this;
    }

    public function withOsnovaResource(OsnovaResource $resource = null)
    {
        $this->resource = $resource;

        return $this;
    }

    public function item()
    {
        return new $this->class($this->data, $this->apiProvider, $this->resource);
    }

    public function collection()
    {
        return array_map(function (array $data) {
            return new $this->class($data, $this->apiProvider, $this->resource);
        }, $this->data);
    }
}
