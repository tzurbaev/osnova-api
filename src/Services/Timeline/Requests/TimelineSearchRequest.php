<?php

namespace Osnova\Services\Timeline\Requests;

class TimelineSearchRequest extends TimelineRequest
{
    /** @var string */
    protected $query;

    /** @var string */
    protected $orderBy;

    /** @var int */
    protected $page;

    /**
     * TimelineSearchRequest constructor.
     *
     * @param string $orderBy
     * @param int    $page
     */
    public function __construct(string $orderBy, int $page = 1)
    {
        parent::__construct('', 0, 0);

        $this->orderBy = $orderBy;
        $this->page = $page;
    }

    /**
     * Set request query.
     *
     * @param string $query
     *
     * @return TimelineSearchRequest
     */
    public function setQuery(string $query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Get parameters for the current request.
     *
     * @return array
     */
    public function getParams()
    {
        return [
            'query' => $this->query,
            'order_by' => $this->orderBy,
            'page' => $this->page,
        ];
    }
}
