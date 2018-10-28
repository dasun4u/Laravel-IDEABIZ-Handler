<?php
/**
 * Created by PhpStorm.
 * User: Dasun Dissanayake
 * Date: 2018-10-28
 * Time: 2:37 AM.
 */

namespace Dasun4u\LaravelIDEABIZHandler;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class ConfigHelper.
 */
class ConfigHelper
{
    /**
     * @var string
     */
    public $environment;

    /**
     * @var string
     */
    public $base_url;

    /**
     * @var string
     */
    public $grant_type;

    /**
     * @var string
     */
    public $scope;

    /**
     * @var string
     */
    public $consumer_key;

    /**
     * @var string
     */
    public $consumer_secret;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;

    /**
     * @var boolean
     */
    public $log_enable;

    /**
     * @var string
     */
    public $log_path;

    /**
     * @var boolean
     */
    public $log_request_headers;

    /**
     * ConfigHelper constructor.
     */
    public function __construct()
    {
        $this->environment = config('ideabiz.environment');
        $this->base_url = config('ideabiz.'.$this->environment.'.base_url');
        $this->grant_type = config('ideabiz.'.$this->environment.'.grant_type');
        $this->scope = config('ideabiz.'.$this->environment.'.scope');
        $this->consumer_key = config('ideabiz.'.$this->environment.'.consumer_key');
        $this->consumer_secret = config('ideabiz.'.$this->environment.'.consumer_secret');
        $this->username = config('ideabiz.username');
        $this->password = config('ideabiz.password');
        $this->log_enable = config('ideabiz.log_enable');
        $this->log_path = config('ideabiz.log_path');
        $this->log_request_headers = config('ideabiz.log_request_headers');
    }

    /**
     * @param string $part
     *
     * @return string $base_url
     */
    public function getUrl($part)
    {
        $base_url = $this->base_url.$part;

        return $base_url;
    }

    /**
     * @return string $authorization_code
     */
    public function getAuthorizationCode()
    {
        $authorization_code = $this->consumer_key.':'.$this->consumer_secret;
        $authorization_code = base64_encode($authorization_code);

        return $authorization_code;
    }

    /**
     * @return array $headers
     */
    public function getAccessTokenGenerateRequestHeaders()
    {
        $headers = [
            'Content-Type'  => 'application/x-www-form-urlencoded',
            'Authorization' => 'Basic '.$this->getAuthorizationCode(),
        ];

        return $headers;
    }

    /**
     * @throws Exceptions\InvalidFileContentException
     *
     * @return array
     */
    public function getAccessTokenGenerateRequestBody()
    {
        if ($this->grant_type == 'password') {
            $request_body = [
                'grant_type' => $this->grant_type,
                'username'   => $this->username,
                'password'   => $this->password,
                'scope'      => $this->scope,
            ];
        } else {
            $auth = new Authentication();
            $request_body = [
                'grant_type'    => $this->grant_type,
                'refresh_token' => $auth->getRefreshToken(),
                'scope'         => $this->scope,
            ];
        }

        return $request_body;
    }

    /**
     * @param null $url
     * @param null $method
     * @param null $request_headers
     * @param null $request_body
     * @param null $response
     * @param null $file_name
     *
     * @throws \Exception
     */
    public function logService($url = null, $method = null, $request_headers = null, $request_body = null, $response = null, $file_name = null)
    {
        if ($this->log_enable) {
            $content = [
                'Request URL'      => $url,
                'Request Method'   => $method,
                'Request Headers'  => $request_headers,
                'Request Body'     => $request_body,
                'Status Code'      => $response->getStatusCode(),
                'Response Headers' => $response->getHeaders(),
                'Response Body'    => json_decode($response->getBody()) != null ? json_decode($response->getBody()) : $response->getBody(),
            ];
            if (!$this->log_request_headers) {
                $content = array_except($content, 'Request Headers');
            }

            $log = new Logger('IDEABIZ');
            $file_name = $file_name != null ? $file_name : date('Y_m_d').'.log';
            $log->pushHandler(new StreamHandler($this->log_path.'/'.$file_name), Logger::INFO);
            $log->info('SERVICE LOG', $content);
        }
    }
}
