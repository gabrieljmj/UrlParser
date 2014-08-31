<?php
namespace Test\Gabrieljmj\UrlParser;

use \PHPUnit_Framework_TestCase;
use Gabrieljmj\UrlParser\UrlParserResult;
use Gabrieljmj\UrlParser\UrlParser;

class UrlParserTests extends PHPUnit_Framework_TestCase
{
	protected function setUp()
	{
		$this->urlParser = new UrlParser();
	}

	/**
	 * @expectedException \Gabrieljmj\UrlParser\Exception\UrlParserException
	*/
	public function testIfThrowsAnExceptionWithAnInvalidUrl()
	{
		$urlData = $this->urlParser->url('this is an invalid url');
	}

	public function testIfWithAValidUrlItReturnsAnInstanceOfUrlParserResultWithCorrectData()
	{
		$correctData = array(
			'protocol' => 'http',
			'host' => 'google.com',
			'tld' => '.com',
			'path' => array('search'),
			'query' => array('q' => 'some+search')
		);
		$urlData = $this->urlParser->url('http://google.com/search?q=some+search');

		$dataToValidate = array(
			'protocol' => $urlData->getProtocol(),
			'host' => $urlData->getHost(),
			'tld' => $urlData->getTld(),
			'path' => $urlData->getPath(),
			'query' => $urlData->getQuery()
		);

		$this->assertEquals($correctData, $dataToValidate);
	}

	public function testIfItReturnsACorrectTldWithSubdomainOn()
	{
		$urlData = $this->urlParser->url('http://sub.google.com', true);

		$this->assertEquals('.com', $urlData->getTld());
	}

	public function testIfItReturnsAnWorngTldWithSubdomainOff()
	{
		$urlData = $this->urlParser->url('http://sub.google.com', false);

		$this->assertEquals('.google.com', $urlData->getTld());
	}

	/**
	 * @expectedException \Gabrieljmj\UrlParser\Exception\UrlParserException
	 * @expectedExceptionMessage The URL there is no a subdomain: http://google.com
	*/
	public function testIfItThrowsAnExceptionWithSubdomainOnAndWithAnInvalidUrl()
	{
		$urlData = $this->urlParser->url('http://google.com', true); //there's no subdomain
	}
}