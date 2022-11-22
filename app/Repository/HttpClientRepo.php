<?php

namespace App\Repository;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use Illuminate\Support\Facades\Log;
use function json_decode;
use Psr\Http\Message\RequestInterface;
use Closure;
use Psr\Http\Message\ResponseInterface;

/**
 * 日志
 * Class LoggerRepo
 * @package App\Http\Repository
 */
class HttpClientRepo {

    /**
     * 构建Handler
     * @return HandlerStack
     */
    public static function buildHandler(): HandlerStack {
        $startTime = microtime(true);
        $stack = new HandlerStack();
        $stack->setHandler(new CurlHandler());
        $stack->push(static::writeLog($startTime));
        return $stack;
    }

    /**
     * 写日志
     * @param int $startTime
     * @return Closure
     */
    private static function writeLog(int $startTime): Closure {
        return function (callable $handler) use ($startTime) {
            return function (RequestInterface $request, array $options) use ($handler, $startTime) {
                $promise = $handler($request, $options);
                return $promise->then(function (ResponseInterface $response) use ($request, $options, $startTime) {
                    $uri = $request->getUri();
                    $data = [
                        'request_url'     => sprintf('%s:%s%s', $uri->getScheme(), $uri->getHost(), $uri->getPath()),
                        'request_method'  => $request->getMethod(),
                        'request_header'  => $request->getHeaders(),
                        'request_param'   => $options['laravel_data'],
                        'response_header' => $response->getHeaders(),
                        'response_body'   => json_decode($response->getBody()->getContents(), true),
                        'tip'             => '',
                        'start_time'      => $startTime,
                        'end_time'        => microtime(true),
                        'spend_time'      => microtime(true) - $startTime,
                    ];
                    Log::info('curl', ['data' => $data]);
                    return $response;
                });
            };
        };
    }
}
