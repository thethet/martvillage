<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Debug\Exception\FatalErrorException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler {
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
		NotFoundHttpException::class,
		FatalErrorException::class,
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e) {
		parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e) {
		/*if ($this->isHttpException($e)) {
		if ($e instanceof NotFoundHttpException) {
		return response()->view('errors.404', [], 404);
		}
		return $this->renderHttpException($e);
		}

		if ($e instanceof HttpException) {
		return response()->view('errors.403', [], 403);

		}

		if ($e instanceof MethodNotAllowedHttpException or $e instanceof ModelNotFoundException or $e instanceof NotFoundHttpException) {
		return response()->view('errors.405', [], 405);

		}*/

		/*if ($e instanceof FatalErrorException) {
		return response()->view('errors.404', [], 404);
		}*/

		if ($this->isHttpException($e)) {

			if (view()->exists('errors.' . $e->getStatusCode())) {

				return response()->view('errors.' . $e->getStatusCode(), [], $e->getStatusCode());

			}

		}

		return parent::render($request, $e);
	}
}
