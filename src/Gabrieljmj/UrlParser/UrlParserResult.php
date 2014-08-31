<?php
/**
 * GabrielJMJ\UrlParser
 *
 * @author GabrielJMJ <gamjj74@hotmail.com>
 * @license MIT License
*/

namespace Gabrieljmj\UrlParser;

class UrlParserResult
{
    /**
     * @var string
    */
    private $protocol;

    /**
     * @var string
    */
    private $host;

    /**
     * @var string
    */
    private $tld;

    /**
     * @var array
    */
    private $path;

    /**
     * @var array
    */
    private $querystrings;

    /**
     * @param string $protocol
     * @param string $host
     * @param string $tld
     * @param array  $path
     * @param array  $querystrings
    */
    public function __construct($protocol, $host, $tld, array $path, array $querystrings)
    {
        $this->protocol = $protocol;
        $this->host = $host;
        $this->tld = $tld;
        $this->path = $path;
        $this->querystrings = $querystrings;
    }

    /**
     * Returns the used protocol
     *
     * @return string
    */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * Returns the host
     *
     * @return string
    */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Returns the tld (.com, .com.br, .net)
     *
     * @return string
    */
    public function getTld()
    {
        return $this->tld;
    }

    /**
     * Returns the path
     *
     * @return array
    */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Returns the querystring params
     *
     * @return array
    */
    public function getQuery()
    {
        return $this->querystrings;
    }
}