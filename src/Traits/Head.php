<?php namespace Cloudtux\Reader\Traits;

trait Head
{

    private $meta = [];

    public function head()
    {

        $this->page->title       = $this->getTitle();
        $this->page->description = $this->getDescription();
        $this->page->head        = $this->getHead();
        $this->page->meta        = $this->getMeta();

        return $this;

    }

    private function getTitle()
    {

        if (preg_match('/<title[^>]*>(.*?)<\/title>/', $this->page->contentData, $results)) {
            return $results[1];
        }

    }

    private function getDescription()
    {

        if (preg_match('/<meta name="description(.*?)>/', $this->page->contentData, $results)) {

            if (preg_match('/content="(.*?)"/', $results[0], $match)) {

                return $match[1];
            }

            return $results[0];

        }

    }

    private function getHead()
    {

        if (preg_match('/<head[^>]*>(.*?)<\/head>/', $this->page->contentData, $matches)) {

            return $matches[1];

        }

    }

    private function getMeta()
    {

        if (preg_match_all('/<meta (.*?)>/i', $this->page->contentData, $results)) {

            return $this->filterMeta($results[0]);

        }

    }

    protected function filterMeta($data)
    {

        foreach ($data as $item) {

            $content = '';

            if (preg_match('/content="(.*?)"/', $item, $result)) {
                $content = $result[1];
            }

            $this->metaName($item, $content);
            $this->metaProperty($item, $content);

        }

        return ksort($this->meta);

    }

    private function metaName($item, $content)
    {

        if (preg_match('/name="(.*?)"/', $item, $result)) {
            $this->meta[$result[1]] = $content;
        }

    }

    private function metaProperty($item, $content){

        if (preg_match('/property="(.*?)"/', $item, $result)) {
            $this->meta[$result[1]] = $content;
        }

    }

}