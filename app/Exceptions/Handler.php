<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    use ApiResponser;
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function render($request, Exception $exception)
    {
        if($exception instanceof HttpException) {
            $code = $exception->getStatusCode();
            $message = Response::$statusTexts[$code];
            return $this->error($message, $code);
        }
        if($exception instanceof ModelNotFoundException) {
            $modelName = class_basename($exception->getModel());
            $message = "there is no instance of {$modelName} model with this given id";
            return $this->error($message, Response::HTTP_NOT_FOUND);
        }
        if($exception instanceof AuthenticationException) {
            return $this->error($exception->getMessage(), Response::HTTP_UNAUTHORIZED);
        }
        if($exception instanceof AuthorizationException) {
            return $this->error($exception->getMessage(), Response::HTTP_FORBIDDEN);
        }
        if($exception instanceof ValidationException) {
            $message = $exception->validator->errors()->getMessages();
            return $this->error($message, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if(env('APP_DEBUG', false)) {
            return parent::render($request, $exception);
        }
        $message = 'unexpected server error, please try later';
        return $this->error($message, Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
