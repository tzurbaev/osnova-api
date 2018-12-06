<?php

namespace Osnova\Services\Timeline\Traits;

trait HasLikes
{
    /**
     * Determines whether the entity was liked by the current user.
     *
     * @return bool
     */
    public function isLiked()
    {
        return $this->getData('likes.is_liked', false) === true;
    }

    /**
     * Get the entity likes count.
     *
     * @return int
     */
    public function getLikesCount()
    {
        return intval($this->getData('likes.count'));
    }

    /**
     * Get the entity likes sum.
     *
     * @return int
     */
    public function getLikesSum()
    {
        return intval($this->getData('likes.summ'));
    }
}
