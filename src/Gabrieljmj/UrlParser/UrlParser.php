<?php
/**
 * GabrielJMJ\UrlParser
 *
 * @author GabrielJMJ <gamjj74@hotmail.com>
 * @license MIT License
*/

namespace Gabrieljmj\UrlParser;

use Gabrieljmj\UrlParser\Exception\UrlParserException;

class UrlParser
{
    /**
     * Host
     *
     * @var string
    */
    private $host;

    /**
     * Querystring params
     *
     * @var array
    */
    private $querystrings;

    /**
     * Protocol name
     *
     * @var string
    */
    private $protocol;

    /**
     * Path
     *
     * @var array
    */
    private $path;

    /**
     * Tld (.com, .net, .org, etc.)
     *
     * @var string
    */
    private $tld;

    /**
     * @var array
    */
    private $explodedUrl;

    /**
     * Url to work on
     *
     * @var string
    */
    private $url;

    /**
     * Return the query strings from a URL
     *
     * @param string $url
     * @return array Queries
    */
    private function setQueryStrings()
    {
        $params = explode('?', $this->url);
        $queries = array();

        if (count($params) > 1) {
            $params = end($params);
            $relations = explode('&', $params);

            $queries = array();

            foreach ($relations as $relation) {
                $camps = explode('=', $relation);
                $queries[ $camps[0] ] = $camps[1];
            }
        }

        $this->querystrings = $queries;
    }

    /**
     * Returns the domain name of an URL
     *
     * @example - http://google.com/search?q=foo
     *          - Returns: google.com
     *          - Protocol 'true': http://google.com
     * @param string  $url
     * @param boolean $protocol
     * @return string
    */
    private function setHost()
    {
        $urlE = $this->explodedUrl;

        $this->host = $urlE[2];
    }

    /**
     * Returns the domain (.com, .net, etc.) of an URL
     *
     * @example - http://google.com/
     *          - Returns: com
     *          - http://google.com.br/
     *          - Returns: com.br
     *          - http://subdomain.google.com
     *          - $hasSubdomain must be true
     *          - Case true: com
     *          - Case false: google.com
     * @param string  $url
     * @param boolean $hasSubdomain
     * @return string
    */
    private function setTld($hasSubdomain = false)
    {
        $urlE = $this->explodedUrl;
        $url = $urlE[2];
        $urlDot = explode('.', $url);

        if ($hasSubdomain) {
            if (count($urlDot) <= 2) {
                throw new UrlParserException('The URL there is no a subdomain: ' . print_r($url, true));
            }

            unset($urlDot[0], $urlDot[1]);

            $this->tld = '.' . implode('.', $urlDot);
        }

        unset($urlDot[0]);
        $this->tld = '.' . implode('.', $urlDot);
    }

    /**
     * Returns the page of an URL
     *
     * @example - http://google.com/search?q=foo/bar
     *          - Returns: search?q=foo/bar
     *          - QueryString off: search
     * @param string $url
     * @param array  $explodedUrl
    */
    private function setPath()
    {
        $urlE = $this->explodedUrl;

        unset($urlE[0], $urlE[1], $urlE[2]);
        $url = implode('/', $urlE);
        $pathE = explode('?', $url);
        $e = explode('/', $pathE[0]);
        $this->path = count($e) == 1 && $e[0] === '' ? array() : $e;
    }

    /**
     * Returns the protocol used
     *
     * @example - http://google.com
     *          - Returns: http
     *          - https://google.com
     *          - Returns: https
     * @param string $url
     * @return string
    */
    private function setProtocol()
    {
        $urlE = $this->explodedUrl;

        $this->protocol = substr($urlE[0], 0, -1);
    }

    /**
     * @param string $url
     * @param boolean $hasSubdomain
     * @return \Attw\Tool\Url\UrlParserResult
    */
    public function url($url, $hasSubdomain = false)
    {
        $this->url = $url;
        $this->explodedUrl = explode('/', $this->url);

        if (!filter_var($this->url, FILTER_VALIDATE_URL)) {
            UrlParserException::invalidUrl($this->url);
        }

        $this->setProtocol();
        $this->setHost();
        $this->setTld($hasSubdomain);
        $this->setPath();
        $this->setQueryStrings();

        return new UrlParserResult($this->protocol, $this->host, $this->tld, $this->path, $this->querystrings);
    }
}