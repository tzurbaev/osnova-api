<?php

namespace Osnova\Services\Comments\Requests;

class CommentThreadRequest extends CommentsRequest
{
    /** @var int */
    protected $commentId;

    /**
     * CommentThreadRequest constructor.
     *
     * @param int $commentId
     */
    public function __construct(int $commentId)
    {
        parent::__construct();

        $this->commentId = $commentId;
    }

    /**
     * Get parameters for the current request.
     *
     * @return array
     */
    public function getParams()
    {
        return [];
    }

    /**
     * Get comment ID.
     *
     * @return int
     */
    public function getCommentId()
    {
        return $this->commentId;
    }

    /**
     * Get base comments URL.
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return 'comments/thread/'.$this->getCommentId();
    }
}
