<?php
namespace Gabrieljmj\UrlParser\Exception;

use \Exception;

class UrlParserException extends Exception
{
    public function invalidUrl($url)
    {
        throw new UrlParserException('Invalid URL passed: ' . $url);
    }
}