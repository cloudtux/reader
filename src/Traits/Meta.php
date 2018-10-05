<?php namespace Cloudtux\Reader\Traits;

trait Meta
{

    protected function filterMeta($data)
    {

        $meta = [];

        foreach ($data as $item) {

            $content = '';

            if (preg_match('/content="(.*?)"/', $item, $contentResult)) {
                $content = $contentResult[1];
            }

            if (preg_match('/name="(.*?)"/', $item, $nameResult)) {
                $meta[$nameResult[1]] = $content;
            }

            if (preg_match('/property="(.*?)"/', $item, $propertyResult)) {
                $meta[$propertyResult[1]] = $content;
            }

        }

        ksort($meta);

        return $meta;

    }


}