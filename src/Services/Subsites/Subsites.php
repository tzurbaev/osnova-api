<?php

namespace Osnova\Services\Subsites;

use GuzzleHttp\Exception\RequestException;
use Osnova\OsnovaResource;
use Osnova\Services\AbstractService;

class Subsites extends AbstractService
{
    /**
     * Get subsite.
     *
     * @param int            $id
     * @param OsnovaResource $resource
     *
     * @return Subsite|null
     */
    public function getSubsite($id, OsnovaResource $resource = null)
    {
        try {
            $response = $this->getApiProvider()->getClient()->request('GET', 'subsite/'.$id);

            return $this->getEntitiesBuilder(Subsite::class)
                ->fromResponse($response)
                ->with($this->apiProvider, $resource)
                ->item();
        } catch (RequestException $e) {
            //
        }

        return null;
    }
}
