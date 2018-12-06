<?php

namespace Osnova\Services\Tweets\Requests;

use Osnova\Services\ServiceRequest;

class TweetsRequest extends ServiceRequest
{
    /** @var string */
    protected $sorting;

    /**
     * TweetsRequest constructor.
     *
     * @param string $sorting
     * @param int    $count
     * @param int    $offset
     */
    public function __construct(string $sorting = 'fresh', int $count = 20, int $offset = 0)
    {
        parent::__construct($count, $offset);

        $this->sorting = $sorting;
    }

    /**
     * Get tweets sorting type.
     *
     * @return string
     */
    public function getSorting()
    {
        return $this->sorting;
    }
}
