<?php namespace Cloudtux\Reader\Traits;

trait Links
{

    public function links()
    {

        $this->getLinks();

        return $this;

    }

    private function getLinks()
    {

        if (preg_match('/<body[^>]*>(.*?)<\/body>/', $this->page->contentData, $results)) {

            if (preg_match_all('/<a [^>]*>(.*?)<\/a>/', $results[0], $results)) {
                return $this->checkLinkTypes($this->clean($results[0]));
            }

        }

    }

    private function checkLinkTypes($links)
    {

        $this->verifyLinks($links, str_replace('http://', '', $this->page->url) );
        $this->checkSSL();

        if (property_exists($this->page->links, 'external') && property_exists($this->page->links->external, 'urls')) {
            $this->page->links->external->count = count($this->page->links->external->urls);
        }

        return true;

    }

    private function verifyLinks($links, $url){

        foreach ($links as $link) {

            if (preg_match('/"http(.*?)"(.*?)>/', $link, $result)) {

                if (preg_match('/"(.*?)' . addcslashes($url, '/') . '(.*?)"(.*?)>/', $link, $result)) {
                    $this->extractLink($link, 'internal');
                } else {
                    $this->extractLink($link, 'external');
                }

            } else {

                $this->extractLink($link, 'internal');

            }

        }

    }

    private function extractLink($link, $type)
    {

        // Urls
        if (preg_match('/href="(.*?)"/', $link, $result)) {

            $url = trim($result[1]);

            if ($url) {

                if ($url[0] == '/' || $url[0] == '#') {

                    $this->page->links->$type->checkSSL[] = $url;

                } else {

                    if (substr($url, 0, 3) != 'tel') {
                        $this->page->links->$type->urls[] = $url;
                    }

                }

            }
        }

        // Keywords
        if (preg_match('/\>(.*?)\</', $link, $result)) {
            if ($result[1] != '' && $result[1] != ' ') {
                $this->page->links->$type->keywords[] = trim($result[1]);
            }
        }

    }

    private function checkSSL()
    {

        if (property_exists($this->page->links, 'internal')) {


            if (property_exists($this->page->links->internal, 'urls')) {

                // Check for SSL
                if (preg_grep('/https/', $this->page->links->internal->urls)) {

                    if (property_exists($this->page->links->internal, 'checkSSL')) {

                        $protocol = ($this->page->ssl) ? 'https://' : 'http://';

                        foreach ($this->page->links->internal->checkSSL as $url) {

                            $this->page->links->internal->urls[] = $protocol . $this->page->domain . $url;

                        }

                        unset($this->page->links->internal->checkSSL);

                    }
                }

                // Check for sub domains
                $this->checkForSubDomains();

                // Count internal links
                $this->page->links->internal->count = 0;
                if (property_exists($this->page->links, 'internal') && property_exists($this->page->links->internal, 'urls')) {
                    $this->page->links->internal->count = count($this->page->links->internal->urls);
                    sort($this->page->links->internal->urls);
                }

            }

        }

    }

    private function checkForSubDomains()
    {

        foreach ($this->page->links->internal->urls as $key => $val) {

            if (preg_match('/\/\/(.*?).' . addcslashes($this->page->domain, '/') . '/', $val, $result)) {
                $this->page->links->internal->subDomains[] = $val;
                unset($this->page->links->internal->urls->$key);
            }

        }

        if (property_exists($this->page->links->internal, 'subDomains')) {
            sort($this->page->links->internal->subDomains);
        }

    }


}