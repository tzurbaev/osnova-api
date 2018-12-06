<?php

namespace Osnova\Services\Timeline;

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
    public function liked()
    {
        return $this->getSign() === 1;
    }

    /**
     * Determines whether the user disliked entity.
     *
     * @return bool
     */
    public function disliked()
    {
        return $this->getSign() === -1;
    }
}
