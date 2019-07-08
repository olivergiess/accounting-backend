<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\AuthenticationException;
use App\Exceptions\AuthenticationHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    /**
     * Prepare exception for rendering.
     *
     * @param  \Exception  $e
     * @return \Exception
     */
    protected function prepareException(Exception $e)
    {
    	if (
    		$e instanceof AuthorizationException ||
			$e instanceof RelationNotFoundException
		)
    	{
            $e = new AccessDeniedHttpException(404, 'Not Found', $e);
        }
        else if ($e instanceof AuthenticationException)
		{
			$e = new AuthenticationHttpException(401, 'Unauthorised', $e);
		}

        return parent::prepareException($e);
    }

    /**
     * Prepare a JSON response for the given exception.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception $e
     * @return \Illuminate\Http\JsonResponse
     */
    protected function prepareJsonResponse($request, Exception $e)
    {
    	$status = $this->isHttpException($e) ? $e->getStatusCode() : 500;

    	$wrappedResponse = [
    		'errors' =>
    			array_merge(
    				$this->convertExceptionToArray($e),
					[
    					'status' => $status
					]
				)
		];

        return new JsonResponse(
            $wrappedResponse,
            $status,
            $this->isHttpException($e) ? $e->getHeaders() : [],
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );
    }
}
