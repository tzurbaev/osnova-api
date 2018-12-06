<?php

namespace Osnova\Services;

use Osnova\Api\ApiProvider;
use Osnova\Support\Traits\BuildsEntities;
use Osnova\Support\Traits\HasApiProvider;

abstract class AbstractService
{
    use HasApiProvider, BuildsEntities;

    /** @var ApiProvider */
    protected $apiProvider;

    /**
     * Subsites constructor.
     *
     * @param ApiProvider $apiProvider
     */
    public function __construct(ApiProvider $apiProvider)
    {
        $this->apiProvider = $apiProvider;
    }
}
