<?php namespace Cloudtux\Reader;

use Cloudtux\Reader\Contracts\ReaderInterface;

class Reader implements ReaderInterface
{

    /**
     * Scan a url|file
     *
     * @param $file
     * @return $this
     */
    public function scan($file)
    {

        $url = !preg_match('/http/', $file) ? 'http://' . $file : false;
        return $this->scanUrl($url);

        // Scan file later...

    }

    private function scanUrl($file){

        $document = new Web\Page();

        return $document->scan($file);

    }


}