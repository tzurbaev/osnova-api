<?php

namespace Osnova\Services\Likes;

use Osnova\Services\Entries\Author;

class Liker extends Author
{
    /**
     * Get like sign.
     * "1" means that user liked entity, "-1" - disliked.
     *
     * @return int
     */
    public function getSign()
    {
        return intval($this->getData('sign'));
    }

    /**
     * Determines whether the user liked entity.
     *
     * @return bool
     */
    public function isLiked()
    {
        return $this->getSign() === 1;
    }

    /**
     * Determines whether the user disliked entity.
     *
     * @return bool
     */
    public function isDisliked()
    {
        return $this->getSign() === -1;
    }
}
