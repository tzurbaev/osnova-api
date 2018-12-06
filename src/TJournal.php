<?php

namespace Osnova;

use Osnova\Services\Subsites\Traits\SubsitesService;
use Osnova\Services\Timeline\Traits\TimelineService;
use Osnova\Services\Tweets\Traits\TweetsService;
use Osnova\Services\Users\Traits\UsersService;

class TJournal extends OsnovaResource
{
    use TimelineService, SubsitesService, TweetsService, UsersService;

    /**
     * Get the resource domain.
     *
     * @return string
     */
    public static function domain()
    {
        return 'tjournal.ru';
    }
}
