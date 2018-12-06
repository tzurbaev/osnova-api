<?php

namespace Osnova\Services\Media;

class Image extends Media
{
    /**
     * Determines whether the media has an audio.
     *
     * @return bool
     */
    public function hasAudio()
    {
        return $this->getData('additionalData.hasAudio') === true;
    }

    /**
     * Get image type.
     *
     * @return string|null
     */
    public function getImageType()
    {
        return $this->getData('additionalData.type');
    }

    /**
     * Get image URL.
     *
     * @return string|null
     */
    public function getUrl()
    {
        return $this->getData('imageUrl');
    }

    /**
     * Get image width.
     *
     * @return int|null
     */
    public function getWidth()
    {
        return $this->getData('size.width');
    }

    /**
     * Get image height.
     *
     * @return int|null
     */
    public function getHeight()
    {
        return $this->getData('size.height');
    }

    /**
     * Get image aspect ratio.
     *
     * @return int|null
     */
    public function getRatio()
    {
        return $this->getData('size.ratio', 0);
    }
}
