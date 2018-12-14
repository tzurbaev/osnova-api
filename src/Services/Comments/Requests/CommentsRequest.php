<?php

namespace Osnova\Services\Comments\Requests;

use Osnova\Services\Comments\Enums\CommentsSorting;
use Osnova\Services\ServiceRequest;

class CommentsRequest extends ServiceRequest
{
    /** @var string */
    protected $sorting;

    /**
     * CommentsRequest constructor.
     *
     * @param string $sorting
     * @param int    $count
     * @param int    $offset
     */
    public function __construct(string $sorting = CommentsSorting::RECENT, int $count = 20, int $offset = 0)
    {
        parent::__construct($count, $offset);

        $this->sorting = $sorting;
    }

    /**
     * Get base comments URL.
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return 'comments/'.$this->getSorting();
    }

    /**
     * Get sorting type value.
     *
     * @return string
     */
    public function getSorting()
    {
        return $this->sorting;
    }
}
