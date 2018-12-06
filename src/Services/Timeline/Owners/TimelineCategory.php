<?php

namespace Osnova\Services\Timeline\Owners;

use Osnova\Services\Timeline\Interfaces\TimelineOwnerInterface;

class TimelineCategory implements TimelineOwnerInterface
{
    /** @var string */
    protected $name;

    /**
     * TimelineCategory constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the timeline URL prefix.
     *
     * @return string
     */
    public function getTimelineUrlPrefix()
    {
        return 'timeline/'.trim($this->name, '/');
    }
}
