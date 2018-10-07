<?php namespace Cloudtux\Reader\Contracts;

abstract class Inspector implements InspectInterface
{

    protected $page;

    abstract function all();

    public function get()
    {

        return $this;

    }

    public function exclude(array $array)
    {

        foreach ($array as $item) {
            unset($this->page->$item);
        }

        return $this;

    }

    public function only(array $array)
    {

        $document = new \stdClass();

        foreach($array as $item){
            $document->$item = $this->page->$item;
        }

        $this->page = $document;

        return $this;

    }

}