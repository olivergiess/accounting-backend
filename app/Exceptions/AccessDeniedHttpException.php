<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class AccessDeniedHttpException extends HttpException
{
    public function __construct(int $statusCode, string $message = null, \Throwable $previous = null, int $code = 0, array $headers = [])
	{
		parent::__construct($statusCode, $message, $previous, $headers, $code);
	}
}
