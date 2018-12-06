<?php

namespace Osnova\Services\Timeline;

use Osnova\Services\ServiceEntity;

class EntryContent extends ServiceEntity
{
    /**
     * Get HTML value of entry content.
     *
     * @return string|null
     */
    public function getHtml()
    {
        return $this->getData('html') ?? '';
    }

    /**
     * Get entry content's version.
     *
     * @return string|null
     */
    public function getVersion()
    {
        return $this->getData('version') ?? '';
    }

    /**
     * Transform current content instance to string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getHtml() ?? '';
    }
}
