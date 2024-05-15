<?php
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use GB\CLI_APP\Libs\HttpHelper;

class HttpHelperTest extends TestCase {
    private $httpHelper;
    private $client;

    protected function setUp(): void {
        $this->client = $this->createMock(Client::class);
        $this->httpHelper = new HttpHelper($this->client);
    }

    public function testCleanInput(): void {
        $method = new ReflectionMethod(HttpHelper::class, 'cleanInput');
        $method->setAccessible(true);

        $result = $method->invokeArgs($this->httpHelper, ["   \n\r   test   \n\r   "]);
        $this->assertEquals('s:4:"test";', $result);
    }

    public function testCallApiFailure(): void {
        $this->client->method('request')
            ->will($this->throwException(new RequestException("Error Communicating with Server", new Request('GET', 'test'))));

        $result = $this->httpHelper->callApi();
        $this->assertEquals('error', $result->getStatus());
        $this->assertEquals('Error Communicating with Server', $result->getData());
    }
/*
    public function testCallApiSuccess(): void {
        $this->client->method('request')
            ->willReturn(new Response(200, [], 'test'));

        $result = $this->httpHelper->callApi();
        $this->assertEquals('success', $result->getStatus());
        $this->assertEquals('s:4:"test";', $result->getData());
    }
    */
}
?>