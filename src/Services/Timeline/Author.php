<?php

namespace Osnova\Services\Timeline;

use Osnova\Services\ServiceEntity;

class Author extends ServiceEntity
{
    /**
     * Get author ID.
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData('id');
    }

    /**
     * Get author name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->getData('name');
    }

    /**
     * Get author's avatar URL.
     *
     * @return string|null
     */
    public function getAvatarUrl()
    {
        return $this->getData('avatar_url');
    }
}
