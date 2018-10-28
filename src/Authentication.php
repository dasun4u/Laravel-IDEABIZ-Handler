<?php

namespace Dasun4u\LaravelIDEABIZHandler;

use App\Http\Controllers\Controller;
use Dasun4u\LaravelIDEABIZHandler\Exceptions\InvalidFileContentException;
use Dasun4u\LaravelIDEABIZHandler\Exceptions\InvalidResponseException;
use Dasun4u\LaravelIDEABIZHandler\Exceptions\TokenGenerateException;
use GuzzleHttp\Client;

/**
 * Class Authentication.
 */
class Authentication extends Controller
{
    /**
     * @var object ConfigHelper
     */
    protected $helper;

    /**
     * @var string
     */
    protected $token_file_path;

    /**
     * @var string
     */
    protected $token_data;

    /**
     * Authentication constructor.
     *
     * @throws InvalidFileContentException
     */
    public function __construct()
    {
        $this->helper = new ConfigHelper();
        $this->token_file_path = storage_path('logs/ideabiz/token.json');
        $this->token_data = $this->getTokenFileContent();
    }

    /**
     * @throws InvalidFileContentException
     *
     * @return mixed
     */
    private function getTokenFileContent()
    {
        $token_file_content = file_get_contents($this->token_file_path);
        $token_data = json_decode($token_file_content);
        if ($token_data != null) {
            return $token_data;
        } else {
            throw new InvalidFileContentException('Invalid file content in generated token file. 
            Please check the token.json file content.', 1);
        }
    }

    /**
     * @throws InvalidFileContentException
     * @throws InvalidResponseException
     * @throws TokenGenerateException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function generateAccessToken()
    {
        $method = 'POST';
        $url = $this->helper->getUrl('/apicall/token');
        $request = [
            'headers'     => $this->helper->getAccessTokenGenerateRequestHeaders(),
            'form_params' => $this->helper->getAccessTokenGenerateRequestBody(),
        ];
        $client = new Client(['http_errors' => false]);
        $response = $client->request($method, $url, $request);
        $this->helper->logService($url, $method, $request['headers'], $request['form_params'], $response, 'token_generate.log');
        $status_code = $response->getStatusCode();
        if ($status_code == 400 || $status_code == 401) {
            throw new TokenGenerateException('Token generation fail. 
            Please check the request payload.', 4);
        } elseif ($status_code == 404) {
            throw new TokenGenerateException('Token generation fail. 
            Please check the request URL', 4);
        } elseif ($status_code == 500) {
            throw new TokenGenerateException('Token generation fail. 
            Please check IDEABIZ server response.', 5);
        }
        $this->setAccessToken($response->getBody());
    }

    /**
     * @throws InvalidFileContentException
     *
     * @return mixed
     */
    public function getAccessToken()
    {
        try {
            $access_token = $this->token_data->access_token;

            return $access_token;
        } catch (\Exception $e) {
            throw new InvalidFileContentException('access_token missing in token file. 
            Please check the token.json file content.', 2);
        }
    }

    /**
     * @throws InvalidFileContentException
     *
     * @return mixed
     */
    public function getRefreshToken()
    {
        try {
            $refresh_token = $this->token_data->refresh_token;

            return $refresh_token;
        } catch (\Exception $e) {
            throw new InvalidFileContentException('refresh_token missing in token file. 
            Please check the token.json file content.', 3);
        }
    }

    /**
     * @param $response_body
     *
     * @throws InvalidResponseException
     */
    public function setAccessToken($response_body)
    {
        $array_body = json_decode($response_body);
        if ($array_body != null) {
            file_put_contents(storage_path('logs/ideabiz/token.json'), json_encode($array_body, JSON_PRETTY_PRINT));
        } else {
            throw new InvalidResponseException('Invalid response format. Please check the token_generate.log file.', 6);
        }
    }
}
