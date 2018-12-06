<?php

namespace Osnova\Services\Timeline\Interfaces;

interface TimelineOwnerInterface
{
    /**
     * Get the timeline URL prefix.
     *
     * @return string
     */
    public function getTimelineUrlPrefix();
}
