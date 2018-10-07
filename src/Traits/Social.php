<?php namespace Cloudtux\Reader\Traits;

use Cloudtux\Reader\Web\Meta;

trait Social
{

    public function social()
    {

        $this->page->social            = new \stdClass();
        $this->page->social->twitter   = $this->getTwitter();
        $this->page->social->openGraph = $this->getOpenGraph();

        return $this;

    }

    private function getTwitter()
    {

        if (preg_match_all('/<meta name="twitter:(.*?)>/', $this->page->contentData, $results)) {

            $meta = new Meta();

            return $meta->filter($results[0]);

        }

    }

    private function getOpenGraph()
    {

        if (preg_match_all('/<meta property="og:(.*?)>/', $this->page->contentData, $results)) {

            $meta = new Meta();

            return $meta->filter($results[0]);

        }

    }


}