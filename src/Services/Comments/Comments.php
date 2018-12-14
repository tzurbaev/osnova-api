<?php

namespace Osnova\Services\Comments;

use GuzzleHttp\Exception\RequestException;
use Osnova\Api\OsnovaResource;
use Osnova\Services\AbstractService;
use Osnova\Services\Comments\Interfaces\HasCommentsListInterface;
use Osnova\Services\ServiceRequest;
use Psr\Http\Message\ResponseInterface;

class Comments extends AbstractService
{
    /**
     * Get comments list for the given commentable entity.
     *
     * @param HasCommentsListInterface $entity   Entity to request comments from.
     * @param ServiceRequest           $request  Comments request params.
     * @param OsnovaResource           $resource = null Osnova resource.
     *
     * @return array|Comment[]
     */
    public function getComments(HasCommentsListInterface $entity, ServiceRequest $request, OsnovaResource $resource = null)
    {
        return $this->getCommentsFrom(
            $entity->getCommentsUrl($request),
            ['query' => $request->getParams()],
            $resource
        );
    }

    /**
     * Load comments from the given URL & with given params.
     *
     * @param string         $url
     * @param array          $params
     * @param OsnovaResource $resource = null
     *
     * @return array|Comment[]
     */
    private function getCommentsFrom(string $url, array $params, OsnovaResource $resource = null)
    {
        try {
            $response = $this->getApiProvider()->getClient()->request('GET', $url, $params);

            return $this->getEntitiesBuilder(Comment::class)
                ->from($this->extractCommentsFromResponse($response))
                ->with($this->apiProvider, $resource)
                ->collection();
        } catch (RequestException $e) {
            //
        }

        return [];
    }

    /**
     * Extract comments list from the given response.
     *
     * @param ResponseInterface $response
     *
     * @return array
     */
    private function extractCommentsFromResponse(ResponseInterface $response)
    {
        $data = json_decode((string) $response->getBody(), true)['result'] ?? [];

        return isset($data['items']) ? $data['items'] : $data;
    }
}
