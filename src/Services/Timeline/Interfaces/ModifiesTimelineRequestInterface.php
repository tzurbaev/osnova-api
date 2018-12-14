<?php

namespace Osnova\Services\Timeline\Interfaces;

use Osnova\Services\Timeline\Requests\TimelineRequest;

interface ModifiesTimelineRequestInterface
{
    /**
     * Modify given timeline request.
     *
     * @param TimelineRequest $request
     *
     * @return TimelineRequest
     */
    public function modifyTimelineRequest($request);
}
