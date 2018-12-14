<?php

namespace Osnova\Services;

class ServiceRequest
{
    /** @var int */
    public $count = 20;

    /** @var int */
    public $offset = 0;

    /**
     * ServiceRequest constructor.
     *
     * @param int $count
     * @param int $offset
     */
    public function __construct(int $count = 20, int $offset = 0)
    {
        $this->count = $count;
        $this->offset = $offset;
    }

    /**
     * Get parameters for the current request.
     *
     * @return array
     */
    public function getParams()
    {
        $reflection = new \ReflectionClass($this);
        /** @var \ReflectionProperty[] $properties */
        $properties = array_filter($reflection->getProperties(), function (\ReflectionProperty $property) {
            return $property->isPublic();
        });

        $params = [];

        foreach ($properties as $property) {
            $params[$property->getName()] = $property->getValue($this);
        }

        return $params;
    }
}
