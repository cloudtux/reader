<?php namespace Cloudtux\Reader\Web;

class Meta
{

    private $meta = [];

    public function filter($data)
    {

        if($data && is_array($data)) {

            foreach ($data as $item) {

                $content = '';

                if (preg_match('/content="(.*?)"/', $item, $result)) {
                    $content = $result[1];
                }

                $this->metaName($item, $content);
                $this->metaProperty($item, $content);

            }

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