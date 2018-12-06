<?php

namespace Osnova\Services\Media;

class CoverImage extends Image
{
    /**
     * Get cover image UUID.
     *
     * @return string|null
     */
    public function getUuid()
    {
        return $this->getData('additionalData.uuid');
    }

    /**
     * Get file size.
     *
     * @return int|null
     */
    public function getFileSize()
    {
        return $this->getData('additionalData.size');
    }

    /**
     * Get thumbnail URL.
     *
     * @return string|null
     */
    public function getThumbnailUrl()
    {
        return $this->getData('thumbnailUrl');
    }

    /**
     * Get image URL.
     *
     * @return string|null
     */
    public function getUrl()
    {
        return $this->getData('url');
    }

    /**
     * Get image size name.
     *
     * @return string|null
     */
    public function getSizeName()
    {
        return $this->getData('size_simple');
    }
}
