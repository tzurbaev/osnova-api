<?php

namespace Osnova\Services\Comments\Interfaces;

use Osnova\Services\ServiceRequest;

interface HasCommentsListInterface
{
    /**
     * Get the comments URL prefix.
     *
     * @param ServiceRequest $request
     *
     * @return string
     */
    public function getCommentsUrl($request);
}
