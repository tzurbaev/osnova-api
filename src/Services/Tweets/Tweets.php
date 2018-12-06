<?php

namespace Osnova\Services\Tweets;

use GuzzleHttp\Exception\RequestException;
use Osnova\Services\AbstractService;
use Osnova\Services\Tweets\Requests\TweetsRequest;

class Tweets extends AbstractService
{
    /**
     * Get tweets list.
     *
     * @param TweetsRequest $request
     *
     * @return array|Tweet[]
     */
    public function getTweets(TweetsRequest $request)
    {
        try {
            $response = $this->getApiProvider()->getClient()->request('GET', 'tweets/'.$request->getSorting(), [
                'query' => $request->getParams(),
            ]);

            return $this->getEntitiesBuilder(Tweet::class)
                ->fromResponse($response)
                ->collection();
        } catch (RequestException $e) {
            //
        }

        return [];
    }
}
