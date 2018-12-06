<?php

namespace Osnova\Services\Media;

use Osnova\Services\ServiceEntity;

class Media extends ServiceEntity
{
    /**
     * Get media type.
     *
     * @return int|null
     */
    public function getType()
    {
        return $this->getData('type');
    }
}
