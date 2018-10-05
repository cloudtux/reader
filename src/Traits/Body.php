<?php namespace Cloudtux\Reader\Traits;

trait Body
{

    public function body()
    {

        $this->page->body    = $this->getBody();
        $tags                    = ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'];
        $this->page->content = new \stdClass();

        foreach ($tags as $tag) {
            $this->page->content->$tag = $this->getHeadings($tag);
        }

        return $this;

    }

    private function getBody()
    {

        if (preg_match('/<body[^>]*>(.*?)<\/body>/', $this->page->contentData, $results)) {
            return $results[0];
        }

    }

    private function getHeadings($tag)
    {

        if (preg_match_all('/<' . $tag . '[^>]*>(.*?)<\/' . $tag . '>/i', $this->page->contentData, $results)) {
            return $results[1];
        }

    }


}