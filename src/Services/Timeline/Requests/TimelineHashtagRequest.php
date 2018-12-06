<?php

namespace Osnova\Services\Timeline\Requests;

class TimelineHashtagRequest extends TimelineRequest
{
    /** @var string */
    public $hashtag;

    /**
     * TimelineHashtagRequest constructor.
     *
     * @param string $hashtag
     * @param int    $count
     * @param int    $offset
     */
    public function __construct(string $hashtag, int $count = 20, int $offset = 0)
    {
        parent::__construct('', $count, $offset);

        $this->hashtag = $hashtag;
    }
}
