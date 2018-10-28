<?php
/**
 * Created by PhpStorm.
 * User: Dasun Dissanayake
 * Date: 2018-10-28
 * Time: 1:48 AM.
 */

namespace Dasun4u\LaravelIDEABIZHandler\Exceptions;

use Exception;
use Throwable;

class InvalidResponseException extends Exception implements LaravelIDEABIZException
{
    /**
     * InvalidResponseException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct(
        $message = 'Invalid response format. Please check the token_generate.log file.',
        $code = 6,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
