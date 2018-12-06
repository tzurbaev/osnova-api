<?php

namespace Osnova\Services;

use Osnova\Api\ApiProvider;
use Osnova\OsnovaResource;
use Osnova\Support\Traits\BuildsEntities;
use Osnova\Support\Traits\HasApiProvider;
use Osnova\Support\Traits\HasOsnovaResource;

abstract class ServiceEntity
{
    use HasApiProvider, HasOsnovaResource, BuildsEntities;

    /** @var array */
    protected $data = [];

    /** @var null|ApiProvider */
    protected $apiProvider;

    /** @var OsnovaResource */
    protected $resource;

    /**
     * ServiceEntity constructor.
     *
     * @param array            $data
     * @param ApiProvider|null $apiProvider
     * @param OsnovaResource   $resource    = null
     */
    public function __construct(array $data = [], ApiProvider $apiProvider = null, OsnovaResource $resource = null)
    {
        $this->data = $data;
        $this->apiProvider = $apiProvider;
        $this->resource = $resource;
    }

    /**
     * Get entity data or value at given path.
     *
     * @param string|null $path    Path.
     * @param string|null $default Default value.
     *
     * @return array|string|mixed
     */
    public function getData(string $path = null, string $default = null)
    {
        if (is_null($path)) {
            return $this->data;
        }

        $keys = explode('.', $path);

        // Quick getters

        if (count($keys) === 1) {
            return $this->data[$keys[0]] ?? $default;
        } elseif (count($keys) === 2) {
            return $this->data[$keys[0]][$keys[1]] ?? $default;
        }

        $data = $this->data;

        foreach ($keys as $key) {
            if (!array_key_exists($keys, $data)) {
                return $default;
            }

            $data = $data[$key];
        }

        return $data;
    }

    /**
     * Make new entity based on given data path.
     *
     * @param string $class
     * @param string $dataPath
     *
     * @return ServiceEntity|null
     */
    protected function makeEntity(string $class, string $dataPath)
    {
        if (!is_array($data = $this->getData($dataPath)) || empty($data)) {
            return null;
        }

        return $this->makeEntityFrom($class, $data);
    }

    /**
     * Make new entity based on given data path.
     *
     * @param string $class
     * @param string $dataPath
     *
     * @return ServiceEntity|null
     */
    protected function makeEntityFrom(string $class, array $data)
    {
        return $this->getEntitiesBuilder($class)
            ->from($data)
            ->with($this->apiProvider, $this->resource)
            ->item();
    }
}
