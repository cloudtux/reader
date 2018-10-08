# Reader
Application to read web pages, documents and more..

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/cloudtux/reader/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/cloudtux/reader/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/cloudtux/reader/badges/build.png?b=master)](https://scrutinizer-ci.com/g/cloudtux/reader/build-status/master)
[![Maintainability](https://api.codeclimate.com/v1/badges/66ff0afd47b7af77245e/maintainability)](https://codeclimate.com/github/cloudtux/reader/maintainability)

## Analyse a web page using Laravel

```php
<?php 
use Cloudtux\Reader\ReadWebPage;

class MyController
{

    private $reader;

    public function __construct(ReadWebPage $reader)
    {
        $this->reader = $reader;
    }

    public function index()
    {

        return $this->reader->scan("github.com");

    }

}

```

## Analyse a web page without framework

```php
<?php 

require __DIR__ . '/vendor/autoload.php';

$scan = new Cloudtux\Reader\Reader();

header('Content-Type: application/json');
echo $scan->scan('github.com');
```