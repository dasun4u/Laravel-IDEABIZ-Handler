<?php

namespace Dasun4u\LaravelIDEABIZHandler;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

/**
 * Class IDEABIZ.
 */
class IDEABIZ extends Controller
{
    /**
     * @param $url
     * @param $method
     * @param $headers
     * @param $request_body
     * @param string $guzzle_body_type
     *
     * @throws Exceptions\InvalidFileContentException
     * @throws Exceptions\InvalidResponseException
     * @throws Exceptions\TokenGenerateException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public static function apiCall($url, $method, $headers, $request_body, $guzzle_body_type = 'json')
    {
        $auth = new Authentication();
        $helper = new ConfigHelper();
        $request = [
            'headers'         => $headers,
            $guzzle_body_type => $request_body,
        ];
        $client = new Client(['http_errors' => false]);
        $response = $client->request($method, $url, $request);
        $helper->logService($url, $method, $request['headers'], $request['json'], $response);
        $status_code = $response->getStatusCode();
        if ($status_code == 401) {
            $auth->generateAccessToken();
            $response = $client->request($method, $url, $request);
        }

        return $response;
    }

    /**
     * @throws Exceptions\InvalidFileContentException
     *
     * @return mixed
     */
    public static function getAccessToken()
    {
        $auth = new Authentication();

        return $auth->getAccessToken();
    }

    /**
     * @throws Exceptions\InvalidFileContentException
     * @throws Exceptions\InvalidResponseException
     * @throws Exceptions\TokenGenerateException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function generateAccessToken()
    {
        $auth = new Authentication();

        return $auth->generateAccessToken();
    }
}
