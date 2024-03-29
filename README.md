GabrielJMJ\UrlParser
====================
[![Total Downloads](https://poser.pugx.org/gabrieljmj/urlparser/downloads.png)](https://packagist.org/packages/gabrieljmj/urlparser) [![Latest Unstable Version](https://poser.pugx.org/gabrieljmj/urlparser/v/unstable.png)](https://packagist.org/packages/gabrieljmj/urlparser) [![License](https://poser.pugx.org/gabrieljmj/urlparser/license.png)](https://packagist.org/packages/gabrieljmj/urlparser) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GabrielJMJ/UrlParser/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GabrielJMJ/UrlParser/?branch=master)

To parse an URL to get informations.

##Download and autoload
###Via Composer
####Download
```json
{
    "require": {
        "gabrieljmj/urlparser": "dev-master"
    }
}
```
####Autoload
```json
{
    "autoload": {
        "psr-4": {
            "Gabrieljmj\\UrlParser\\": "vendor/gabrieljmj/urlparser/src/Gabrieljmj/UrlParser/",
            "Test\\": "tests/"
        }
    }
}
```
##Examples
```php
use Gabrieljmj\UrlParser\UrlParser;

$urlParser = new UrlParser();
$urlData = $urlParser->url('https://github.com/search?q=some+search');

echo 'Protocol: ' . $urlData->getProtocol() . "\n" .
     'Host: ' . $urlData->getHost() . "\n" .
     'Tld: ' . $urlData->getTld() . "\n" .
     'Path: ' . print_r($urlData->getPath(), true) . "\n" .
     'Query: ' . print_r($urlData->getQuery, true);
```
Returns:
```php
Protocol: https
Host: github.com
Tld: .com
Path: Array([0] => search)
Query: Array([q] => some+search)
```
URL has subdomain: Pass as second param on ```Gabrieljmj\UrlParser\UrlParser::url(string $url [, boolean $hasSubsmain = false])``` the value ```true```.