<?php

namespace GB\CLI_APP\Libs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GB\CLI_APP\DataTransferObjects\HttpClientCallApiDto;

/**
 * HTTP API Caller via GuzzleHttp
 */
class HttpHelper {
    private Client $client;

    public function __construct() {
        $this->client = new Client([
            'base_uri' => $_ENV['API_BASE_URL'],
        ]);
    }

    /**
     * Cleans an input from an API
     * The expected string is from JSON and might contain whitespaces.
     * 
     * @param string $jsonString
     * @return string
     */
    private function cleanInput ($jsonString): string {
        $jsonString = trim($jsonString);
        $jsonString = str_replace(array("  ", "\n", "\r"), "", $jsonString);
        $jsonString = serialize($jsonString);

        return $jsonString;
    }

    /**
     * Call a HTTP API endpoint
     *
     * @note simulates a 20% request failure when the status will be fail,
     * @return HttpClientCallApiDto
     * @throws GuzzleException
     */
    public function callApi(): HttpClientCallApiDto {
        if (rand(1, 100) <= 20) {
            return new HttpClientCallApiDto('fail', '{"message": "Simulated failure"}');
        }

        try {
            $response = $this->client->request('GET', $_ENV['API_BASE_PATH'], [
                'headers' => [
                    'Api-Key' => $_ENV['API_KEY'],
                    'Api-Secret' => $_ENV['API_SECRET'],
                ],
            ]);
            $save = $this->cleanInput($response->getBody()->getContents());

            return new HttpClientCallApiDto('success', $save);
        } catch (GuzzleException $e) {
            return new HttpClientCallApiDto('error', $e->getMessage());
        }
    }
}
