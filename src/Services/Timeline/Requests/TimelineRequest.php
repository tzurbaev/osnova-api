<?php

namespace Osnova\Services\Timeline\Requests;

use Osnova\Services\ServiceRequest;

class TimelineRequest extends ServiceRequest
{
    /** @var string */
    protected $sorting;

    /**
     * TimelineRequest constructor.
     *
     * @param string $sorting = 'recent' Timeline sorting.
     * @param int    $count   = 20 Timeline entries count.
     * @param int    $offset  = 0 Timline entries offset.
     */
    public function __construct(string $sorting = 'recent', int $count = 20, int $offset = 0)
    {
        parent::__construct($count, $offset);

        $this->sorting = $sorting;
    }

    /**
     * Get sorting type for the current request.
     *
     * @return string
     */
    public function getSorting()
    {
        return $this->sorting;
    }
}
