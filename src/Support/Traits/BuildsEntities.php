<?php

namespace Osnova\Support\Traits;

use Osnova\Support\EntitiesBuilder;

trait BuildsEntities
{
    /**
     * Get the entities builder instance for the given class.
     *
     * @param string $class
     *
     * @return EntitiesBuilder
     */
    public function getEntitiesBuilder(string $class)
    {
        return EntitiesBuilder::make($class);
    }
}
