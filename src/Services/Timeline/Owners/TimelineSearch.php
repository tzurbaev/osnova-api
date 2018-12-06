<?php

namespace Osnova\Services\Timeline\Owners;

use Osnova\Services\Timeline\Interfaces\ModifiesTimelineRequest;
use Osnova\Services\Timeline\Interfaces\TimelineOwnerInterface;
use Osnova\Services\Timeline\Requests\TimelineRequest;
use Osnova\Services\Timeline\Requests\TimelineSearchRequest;

class TimelineSearch implements TimelineOwnerInterface, ModifiesTimelineRequest
{
    /** @var string */
    protected $query;

    /**
     * TimelineSearch constructor.
     *
     * @param string $query
     */
    public function __construct(string $query)
    {
        $this->query = $query;
    }

    /**
     * Modify given timeline request.
     *
     * @param TimelineRequest|TimelineSearchRequest $request
     *
     * @return TimelineSearchRequest
     */
    public function modifyTimelineRequest($request)
    {
        if ($request instanceof TimelineSearchRequest) {
            return $request->setQuery($this->query);
        }

        return (new TimelineSearchRequest('relevant'))->setQuery($this->query);
    }

    /**
     * Get the timeline URL prefix.
     *
     * @return string
     */
    public function getTimelineUrlPrefix()
    {
        return 'search';
    }
}
