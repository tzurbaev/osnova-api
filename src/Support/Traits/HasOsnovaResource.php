<?php

namespace Osnova\Support\Traits;

use Osnova\Exceptions\OsnovaResourceDoesNotExistsException;
use Osnova\OsnovaResource;

trait HasOsnovaResource
{
    /**
     * Determines whether the current object has OsnovaResource instance.
     *
     * @return bool
     */
    public function hasOsnovaResource()
    {
        return !is_null($this->resource);
    }

    /**
     * Get the OsnovaResource instance.
     *
     * @return OsnovaResource
     */
    public function getOsnovaResource()
    {
        if (!$this->hasOsnovaResource()) {
            throw new OsnovaResourceDoesNotExistsException(
                'Current instance of the "'.get_class($this).'" class has no OsnovaResource instance!'
            );
        }

        return $this->resource;
    }
}
