<?php

namespace Osnova\Support\Traits;

use Osnova\Api\ApiProvider;
use Osnova\Exceptions\ApiProviderDoesNotExistsException;

trait HasApiProvider
{
    /**
     * Determines whether the current object has ApiProvider instance.
     *
     * @return bool
     */
    public function hasApiProvider()
    {
        return !is_null($this->apiProvider);
    }

    /**
     * Get the ApiProvider instance.
     *
     * @throws ApiProviderDoesNotExistsException
     *
     * @return ApiProvider
     */
    public function getApiProvider()
    {
        if (!$this->hasApiProvider()) {
            throw new ApiProviderDoesNotExistsException(
                'Current instance of the "'.get_class($this).'" class has no ApiProvider instance!'
            );
        }

        return $this->apiProvider;
    }
}
