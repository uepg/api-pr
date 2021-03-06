<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        ApiprException::class,
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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ApiprException) {
            return new JsonResponse([
                'mensagem'=> $exception->getMessage(),
            ], $exception->getCode());
        }

        if (Str::contains($exception->getMessage(), 'certificate has expired')) {
            return new JsonResponse([
                'mensagem'=> 'O certificado do agente de autenticação está expirado, por favor entre em contato com o administrador do domínio: ' .
                    Str::after($request->get('user', '"não identificado"'), '@'),
            ], 502);
        }

        return parent::render($request, $exception);
    }
}
