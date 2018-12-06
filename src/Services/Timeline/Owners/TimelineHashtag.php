<?php

namespace Osnova\Services\Timeline\Owners;

use Osnova\Services\Timeline\Interfaces\ModifiesTimelineRequest;
use Osnova\Services\Timeline\Interfaces\TimelineOwnerInterface;
use Osnova\Services\Timeline\Requests\TimelineHashtagRequest;
use Osnova\Services\Timeline\Requests\TimelineRequest;

class TimelineHashtag implements TimelineOwnerInterface, ModifiesTimelineRequest
{
    /** @var string */
    protected $hashtag;

    /**
     * TimelineHashtag constructor.
     *
     * @param string $hashtag
     */
    public function __construct(string $hashtag)
    {
        $this->hashtag = $hashtag;
    }

    /**
     * Get the timeline URL prefix.
     *
     * @return string
     */
    public function getTimelineUrlPrefix()
    {
        return 'timeline/mainpage';
    }

    /**
     * Modify given timeline request.
     *
     * @param TimelineRequest $request
     *
     * @return TimelineRequest
     */
    public function modifyTimelineRequest($request)
    {
        return new TimelineHashtagRequest(
            $this->hashtag,
            $request->count,
            $request->offset
        );
    }
}
