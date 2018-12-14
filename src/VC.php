<?php

namespace Osnova;

use Osnova\Api\OsnovaResource;
use Osnova\Services\Comments\Traits\CommentsService;
use Osnova\Services\Likes\Traits\LikesService;
use Osnova\Services\Subsites\Traits\SubsitesService;
use Osnova\Services\Timeline\Traits\TimelineService;
use Osnova\Services\Users\Traits\UsersService;

class VC extends OsnovaResource
{
    use TimelineService, CommentsService, LikesService,
        SubsitesService, UsersService;

    /**
     * Get the resource domain.
     *
     * @return string
     */
    public static function domain()
    {
        return 'vc.ru';
    }
}
