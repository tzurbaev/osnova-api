<?php

namespace Osnova\Services\Subsites;

use Osnova\Services\ServiceEntity;
use Osnova\Services\Timeline\Interfaces\TimelineOwnerInterface;

class Subsite extends ServiceEntity implements TimelineOwnerInterface
{
    /**
     * Get subsite ID.
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData('id');
    }

    /**
     * Get subsite URL.
     *
     * @return string|null
     */
    public function getUrl()
    {
        return $this->getData('url');
    }

    /**
     * Get subsite type.
     *
     * @return int|null
     */
    public function getType()
    {
        return $this->getData('type');
    }

    /**
     * Get subsite name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->getData('name');
    }

    /**
     * Get subsite description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->getData('description');
    }

    /**
     * Get subsite avatar URL.
     *
     * @return string|null
     */
    public function getAvatarUrl()
    {
        return $this->getData('avatar_url');
    }

    /**
     * Get subsite head cover.
     *
     * @return mixed
     */
    public function getHeadCover()
    {
        return $this->getData('head_cover');
    }

    /**
     * Get the timeline URL prefix.
     *
     * @return string
     */
    public function getTimelineUrlPrefix()
    {
        return 'subsite/'.$this->getId().'/timeline';
    }
}
