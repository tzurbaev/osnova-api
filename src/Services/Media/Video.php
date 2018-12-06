<?php

namespace Osnova\Services\Media;

class Video extends Media
{
    /**
     * Get video cover URL.
     *
     * @return string|null
     */
    public function getImageUrl()
    {
        return $this->getData('imageUrl');
    }

    /**
     * Get video iframe URL.
     *
     * @return string|null
     */
    public function getIframeUrl()
    {
        return $this->getData('iframeUrl');
    }

    /**
     * Get video service name.
     *
     * @return string|null
     */
    public function getService()
    {
        return $this->getData('service');
    }
}
