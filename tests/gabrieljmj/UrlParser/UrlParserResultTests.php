<?php
namespace Test\Gabrieljmj\UrlParser;

use \PHPUnit_Framework_TestCase;
use Gabrieljmj\UrlParser\UrlParserResult;

class UrlParserResultTests extends PHPUnit_Framework_TestCase
{
	public function testIfArgumentsPassedAreCorrect()
	{
		$protocol = 'http';
		$host = 'foo.com';
		$tld = '.com';
		$path = array('search');
		$query = array('q' => 'bar');
		$result = new UrlParserResult($protocol, $host, $tld, $path, $query);

		$this->assertAttributeEquals($protocol, 'protocol', $result);
		$this->assertAttributeEquals($host, 'host', $result);
		$this->assertAttributeEquals($tld, 'tld', $result);
		$this->assertAttributeEquals($path, 'path', $result);
		$this->assertAttributeEquals($query, 'query', $result);
	}

	public function testGetterForProtocolReturnsTheSamePassedOnConstructor()
	{
		$protocol = 'http';
		$result = new UrlParserResult($protocol, '', '', array(), array());

		$this->assertEquals($protocol, $result->getProtocol());
	}

	public function testGetterForHostReturnsTheSamePassedOnConstructor()
	{
		$host = 'google.com';
		$result = new UrlParserResult('', $host, '', array(), array());

		$this->assertEquals($host, $result->getHost());
	}

	public function testGetterForTldReturnsTheSamePassedOnConstructor()
	{
		$tld = '.com';
		$result = new UrlParserResult('', '', $tld, array(), array());

		$this->assertEquals($tld, $result->getTld());
	}

	public function testGetterForPathReturnsTheSamePassedOnConstructor()
	{
		$path = array('search', 'images');
		$result = new UrlParserResult('', '', '', $path, array());

		$this->assertEquals($path, $result->getPath());
	}

	public function testGetterForQueryReturnsTheSamePassedOnConstructor()
	{
		$query = array('q' => 'cats');
		$result = new UrlParserResult('', '', '', array(), $query);

		$this->assertEquals($query, $result->getQuery());
	}
}