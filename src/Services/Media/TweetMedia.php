<?php

namespace Osnova\Services\Media;

class TweetMedia extends Media
{
    /**
     * Get thumbnail URL.
     *
     * @return string|null
     */
    public function getThumbnailUrl()
    {
        return $this->getData('thumbnail_url');
    }

    /**
     * Get URL.
     *
     * @return string|null
     */
    public function getUrl()
    {
        return $this->getData('media_url');
    }

    /**
     * Get thumbnail width.
     *
     * @return int
     */
    public function getThumbnailWidth()
    {
        return intval($this->getData('thumbnail_width'));
    }

    /**
     * Get thumbnail height.
     *
     * @return int
     */
    public function getThumbnailHeight()
    {
        return intval($this->getData('thumbnail_height'));
    }

    /**
     * Get aspect ratio.
     *
     * @return int|float|null
     */
    public function getRatio()
    {
        return $this->getData('ratio');
    }
}
