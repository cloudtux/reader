<?php namespace Cloudtux\Reader\Traits;

trait Scripts
{

    public function scripts()
    {

        $this->page->scripts       = new \stdClass();
        $this->page->scripts->head = $this->getScripts('head');
        $this->page->scripts->body = $this->getScripts();

        return $this;

    }

    private function getScripts($type = false)
    {

        if ($type == 'head') {

            if (preg_match('/<head[^>]*>(.*?)<\/head>/', $this->page->contentData, $matches)) {

                if (preg_match('/<script (.*?)<\/script>/', $matches[0], $results)) {
                    return $results[0];
                }
            }

        }

        if (preg_match('/<body[^>]*>(.*?)<\/body>/', $this->page->contentData, $matches)) {

            if (preg_match('/<script (.*?)<\/script>/', $matches[0], $results)) {
                return $results[0];
            }
        }

    }

}