<?php namespace Cloudtux\Reader\Contracts;

interface InspectInterface{

    public function all();
    public function get();
    public function exclude(array $array);
    public function only(array $array);

}