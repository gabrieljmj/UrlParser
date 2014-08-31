<?php
/**
 * GabrielJMJ\UrlParser
 *
 * @author GabrielJMJ <gamjj74@hotmail.com>
 * @license MIT License
*/

namespace Gabrieljmj\UrlParser\Exception;

use \Exception;

class UrlParserException extends Exception
{
    public function invalidUrl($url)
    {
        throw new UrlParserException('Invalid URL passed: ' . $url);
    }
}