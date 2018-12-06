<?php

namespace Osnova;

use Osnova\Services\Subsites\Traits\SubsitesService;
use Osnova\Services\Timeline\Traits\TimelineService;
use Osnova\Services\Users\Traits\UsersService;

class VC extends OsnovaResource
{
    use TimelineService, SubsitesService, UsersService;

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
