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

/**
 * Class TokenGenerateException.
 */
class TokenGenerateException extends Exception implements LaravelIDEABIZException
{
    /**
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct(
        $message = 'Token generation fail. Please check the token_generate.log file.',
        $code = 4,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
