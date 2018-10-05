[![Maintainability](https://api.codeclimate.com/v1/badges/66ff0afd47b7af77245e/maintainability)](https://codeclimate.com/github/cloudtux/reader/maintainability)

# Reader
Application to read web pages, documents and more..

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