<?php namespace Cloudtux\Reader\Web;

class Clean
{

    public function code($data)
    {

        $data = preg_replace('/class="(.*?)"/i', "", $data);
        $data = preg_replace('/<span style="(.*?)"\/>/i', "", $data);
        $data = preg_replace('/style="(.*?)"/i', "", $data);
        $data = preg_replace('/<i >(.*?)<\/i>/i', "", $data);
        $data = preg_replace('/<a\s+href/i', "<a href", $data);
        $data = preg_replace('/<svg[^>]*>(.*?)<\/svg>/', "", $data);
        $data = preg_replace('/\s+/', ' ', $data);

        $data = $this->correctTags($data);

        return $data;

    }

    private function correctTags($data){

        $tags = ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'];

        foreach ($tags as $tag) {
            $data = preg_replace('/<' . $tag .'\s+>/i', "<" . $tag . ">", $data);
        }

        return $data;

    }



}