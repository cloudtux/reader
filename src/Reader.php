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

        if (filter_var($file, FILTER_VALIDATE_URL)) {

            return $this->scanUrl($file);

        }

        // Scan file later...


    }

    private function scanUrl($file){

        if(!preg_match('/http/', $file)) {
            $file = 'http://' . $file;
        }

        $document = new Web\Page();

        return $document->scan($file);

    }


}