<?php

namespace Osnova\Services\Subsites\Traits;

use Osnova\Api\ApiProvider;
use Osnova\Services\Subsites\Subsite;
use Osnova\Services\Subsites\Subsites;

trait SubsitesService
{
    /** @var Subsites|null */
    private $subsites;

    /**
     * Get the resource API Provider instance.
     *
     * @return ApiProvider
     */
    abstract public function getApiProvider();

    /**
     * Get the subsites service instance.
     *
     * @param bool $reload = false Reload instance flag.
     *
     * @return Subsites()
     */
    public function getSubsitesService(bool $reload = false)
    {
        if (is_null($this->subsites) || $reload) {
            return $this->subsites = new Subsites($this->getApiProvider());
        }

        return $this->subsites;
    }

    /**
     * Get subsite.
     * This is a proxy method for Subsites::getSubsite().
     *
     * @param int $id
     *
     * @see Subsites::getSubsite()
     *
     * @return Subsite|null
     */
    public function getSubsite($id)
    {
        return $this->getSubsitesService()->getSubsite($id, $this);
    }
}
