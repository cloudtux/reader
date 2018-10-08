<?php namespace Cloudtux\Reader\Web;

use Cloudtux\Reader\Cache\Cache;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class Scan
{

    public    $result;
    protected $data;
    protected $client;
    protected $url;
    protected $cacheTime = 300;
    protected $carbon;
    protected $cache;

    public function __construct()
    {
        $this->client = new Client();
        $this->carbon = new Carbon();
        $this->cache = new Cache();
    }

    public function fetch($url)
    {

        $this->data            = new \stdClass();
        $this->data->url       = $url;
        $this->data->startTime = $this->carbon->now();

        return $this;

    }

    public function basic()
    {

        if (!$this->cache->has($this->data->url)) {

            $response = $this->client->request('GET', $this->data->url);

            return $this->setResponse($response, 'basic');

        }

        return $this->getCache($this->cache->get($this->data->url));

    }

    public function async()
    {

        if (!$this->cache->has($this->data->url)) {

            $request = new Request('GET', $this->data->url);

            $response = $this->client->sendAsync($request)->then(function ($res) {
                return $res;
            });

            return $this->setResponse($response->wait(), 'async');

        }

        return $this->getCache($this->cache->get($this->data->url));

    }

    private function setResponse($response, $request_type)
    {

        $this->data->endTime     = $this->carbon->now();
        $this->data->requestType = $request_type;
        $this->data->status      = $response->getStatusCode();
        $this->data->createdAt   = $this->carbon->now();
        $this->data->contentType = $response->getHeaderLine('content-type');
        $this->data->contentData = $response->getBody()->getContents();

        $this->cache->put($this->data->url, $this->data, $this->cacheTime);

        return $this->data;

        /*
        return Cache::remember($this->data->url, $this->cacheTime, function () use ($response, $request_type) {

            $this->data->endTime     = $this->carbon->now();
            $this->data->requestType = $request_type;
            $this->data->status      = $response->getStatusCode();
            $this->data->createdAt   = $this->carbon->now();
            $this->data->contentType = $response->getHeaderLine('content-type');
            $this->data->contentData = $response->getBody()->getContents();

            return $this->data;

        });
        */

    }

    private function getCache($cache)
    {

        $this->data              = $cache;
        $this->data->contentData = preg_replace('#\n#', '', $this->data->contentData);
        $this->data->contentData = preg_replace('#\r#', '', $this->data->contentData);

        return $this->data;

    }

    public function get()
    {

        return $this->data;

    }

}