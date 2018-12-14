<?php

namespace Osnova\Services\Timeline\Requests;

use Osnova\Services\ServiceRequest;
use Osnova\Services\Timeline\Enums\TimelineSorting;

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
    public function __construct(string $sorting = TimelineSorting::RECENT, int $count = 20, int $offset = 0)
    {
        parent::__construct($count, $offset);

        $this->sorting = $sorting;
    }

    /**
     * Set request sorting.
     *
     * @param string $sorting
     *
     * @return TimelineRequest
     */
    public function setSorting(string $sorting)
    {
        $this->sorting = $sorting;

        return $this;
    }

    /**
     * Disable request sorting.
     *
     * @return TimelineRequest
     */
    public function withoutSorting()
    {
        return $this->setSorting('');
    }

    /**
     * Determines whether the request has sorting.
     *
     * @return bool
     */
    public function hasSorting()
    {
        return $this->sorting !== '';
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
