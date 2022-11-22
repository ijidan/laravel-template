<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Arr;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;


/**
 * 异常处理
 * Class Handler
 * @package App\Exceptions
 */
class Handler extends ExceptionHandler {

    /**
     * A list of the exception types that are not reported.
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [//
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     * @return void
     */
    public function register() {
        $this->reportable(function (Throwable $e) {
            $data = $this->convertExceptionToArray($e);
            Log::error('error', $data);
        })->stop();
    }

    /**
     * 异常渲染
     * @param           $request
     * @param Throwable $e
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|Response
     * @throws Throwable
     */
    public function render($request, Throwable $e) {
        if ($request->wantsJson()) {
            $data = $this->convertExceptionToArray($e);
            return \response()->json($data);
        }
        return parent::render($request, $e); // TODO: Change the autogenerated stub
    }

    /**
     * 异常转化为数组
     * @param Throwable $e
     * @param int       $code
     * @return array
     */
    protected function convertExceptionToArray(Throwable $e, int $code = Response::HTTP_INTERNAL_SERVER_ERROR): array {
        if ($e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException) {
            $code = Response::HTTP_NOT_FOUND;
        } else {
            $code = $e->getCode() ?: $code;
        }
        return config('app.debug') ? [
            'code'    => $code,
            'message' => $code == Response::HTTP_NOT_FOUND ? '数据不存在' : trans($e->getMessage()),
            'data'    => [
                'exception' => get_class($e),
                'file'      => $e->getFile(),
                'line'      => $e->getLine(),
                'trace'     => collect($e->getTrace())->map(function ($trace) {
                    return Arr::except($trace, ['args']);
                })->all(),
            ]
        ] : [
            'code'    => $code,
            'message' => $this->isHttpException($e) ? trans($e->getMessage()) : 'Server Error',
            'data'    => new \stdClass()
        ];
    }
}