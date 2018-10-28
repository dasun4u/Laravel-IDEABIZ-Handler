<?php
/**
 * Created by PhpStorm.
 * User: Dasun Dissanayake
 * Date: 2018-10-27
 * Time: 11:49 PM.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Environment
    |--------------------------------------------------------------------------
    |
    | Environment "production" or "staging"
    |
    */
    'environment' => 'production',

    /*
    |--------------------------------------------------------------------------
    | username and password
    |--------------------------------------------------------------------------
    |
    | 'username' and 'password' are required when 'grant_type' is 'password'
    |
    */
    'username' => env('IDEABIZ_USERNAME', ''),
    'password' => env('IDEABIZ_PASSWORD', ''),

    /*
    |--------------------------------------------------------------------------
    | Base URL and token generation parameters
    |--------------------------------------------------------------------------
    |
    | 'grant_type' must be 'refresh_token' or 'password'.
    | 'refresh_token' recommended for single node applications and
    | 'password' recommended for multi node applications.
    | 'scope' must be 'PRODUCTION' or 'SANDBOX'.
    | 'consumer_key' and 'consumer_secret' are provided by the IDEABIZ team.
    | These are unique keys for the created APP.
    |
    */
    'production' => [
        'base_url'        => 'https://ideabiz.lk',
        'grant_type'      => 'refresh_token',
        'scope'           => 'PRODUCTION',
        'consumer_key'    => env('IDEABIZ_PRODUCTION_CONSUMER_KEY', ''),
        'consumer_secret' => env('IDEABIZ_PRODUCTION_CONSUMER_SECRET', ''),
    ],

    'staging' => [
        'base_url'        => 'https://ideabiz.lk',
        'grant_type'      => 'refresh_token',
        'scope'           => 'SANDBOX',
        'consumer_key'    => env('IDEABIZ_SANDBOX_CONSUMER_KEY', ''),
        'consumer_secret' => env('IDEABIZ_SANDBOX_CONSUMER_SECRET', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | Log Enable
    |--------------------------------------------------------------------------
    |
    | Log enable must be true or false. true is recommended for safety reasons
    |
    */
    'log_enable' => true,

    /*
    |--------------------------------------------------------------------------
    | Log Path
    |--------------------------------------------------------------------------
    |
    | If 'log_enable' is true then log files generated in this path
    |
    */
    'log_path' => storage_path('logs/ideabiz/logs'),

    /*
    |--------------------------------------------------------------------------
    | Log Request Headers
    |--------------------------------------------------------------------------
    |
    | If 'log_request_headers' is true then log request headers also
    | (Precondition - 'log_enable' => true)
    |
    */
    'log_request_headers' => true,

];
