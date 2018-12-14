<?php

namespace Osnova\Services\Timeline\Owners;

use Osnova\Services\Timeline\Interfaces\TimelineOwnerInterface;

class NewsTimeline implements TimelineOwnerInterface
{
    /**
     * Get the timeline URL prefix.
     *
     * @return string
     */
    public function getTimelineUrlPrefix()
    {
        return 'news/default';
    }
}
