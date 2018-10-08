<?php namespace Cloudtux\Reader\Cache;

class Cache{

    protected $cache;

    public function __construct(){


        $path = function_exists('storage_path') ? storage_path('framework/cache/data') : 'cache';

        $filestore = new \Illuminate\Cache\FileStore(
            new \Illuminate\Filesystem\Filesystem(),
           $path
        );

        $this->cache = new \Illuminate\Cache\Repository($filestore);

    }

    public function put($file, $data, $time){

        $this->cache->put($file, $data, $time);

    }

    public function get($file){

        return $this->cache->get($file);

    }

    public function has($file){

        return $this->cache->has($file);

    }

}