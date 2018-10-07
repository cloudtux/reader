# Reader
Application to read web pages, documents and more..

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/spatie/laravel-backup/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/spatie/laravel-backup/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/cloudtux/reader/badges/build.png?b=master)](https://scrutinizer-ci.com/g/cloudtux/reader/build-status/master)
[![Maintainability](https://api.codeclimate.com/v1/badges/66ff0afd47b7af77245e/maintainability)](https://codeclimate.com/github/cloudtux/reader/maintainability)

# Analyse a web page
```
use Cloudtux\Reader\ReadWebPage;

class HomeController extends Controller
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