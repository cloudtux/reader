<?php namespace Cloudtux\Reader\Web;

use Cloudtux\Reader\Contracts\ReaderInterface;

class Page implements ReaderInterface
{

    public $scan;

    public function __construct()
    {
        $this->scan = new Scan();
    }

    public function scan($url)
    {

        $page = new Inspect($this->scan->fetch($url)->async());

        return $page->all();

    }

}