<?php namespace Cloudtux\Reader\Web;

use Cloudtux\Reader\Contracts\Inspector;

use Cloudtux\Reader\Traits\{
    Head, Scripts, Social, Body, Links
};

class Inspect extends Inspector
{

    use Head, Scripts, Social, Body, Links;

    protected $page;

    public function __construct($page)
    {
        $this->page = $page;

        $this->findRootUrl();
    }

    public function all()
    {

        $this->head()->body()->scripts()->social()->links();

        return $this->page;
    }

    private function findRootUrl()
    {

        // Get domain
        $domain             = str_replace('https://', '', $this->page->url);
        $domain             = str_replace('http://', '', $domain);
        $domain             = explode('/', $domain);
        $this->page->domain = $domain[0];

        // Check if url is using SSL
        $this->page->ssl = (preg_match('/https/', $this->page->url)) ? true : false;

    }

}