<?php

namespace App\Repository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use App\Models\User;
use function json_decode;

/**
 * 日志
 * Class LoggerRepo
 * @package App\Http\Repository
 */
class LoggerRepo extends Log {

    /**
     * 构建请求日志
     * @param Request  $request
     * @param Response $response
     * @return array|\array[][]
     */
    public function buildRequestLog(Request $request, Response $response): array {
        $type = 'req';
        $common = $this->buildCommonPart($type);
        $extra = [
            'data' => [
                'request'  => [
                    'url'    => $request->getUri(),
                    'method' => $request->getMethod(),
                    'header' => $request->headers->all(),
                    'param'  => $request->all(),
                    'ip'     => $request->getClientIps(),
                ],
                'response' => [
                    'status_code' => $response->getStatusCode(),
                    'header'      => $response->headers->all(),
                    'body'        => json_decode($response->content(), true)
                ],
            ],
        ];
        $log = array_merge($common, $extra);
        return $log;
    }

    /**
     * 构建SQL日志
     * @param float  $duration
     * @param string $realSql
     * @return array
     */
    public function buildSqlLog(float $duration, string $realSql): array {
        $type = 'sql';
        $common = $this->buildCommonPart($type);
        $extra = [
            'data' => [
                'duration' => $duration,
                'query'    => $realSql
            ]
        ];
        return array_merge($common, $extra);
    }


    /**
     * 构建业务日志
     * @param string $message
     * @param array  $extra
     * @return array
     */
    public function buildBusinessLog(string $message, array $extra): array {
        $type = 'business';
        $common = $this->buildCommonPart($type);
        $extra = [
            'data' => [
                'message' => $message,
                'extra'   => $extra
            ]
        ];
        return array_merge($common, $extra);
    }

    /**
     * 构建NET请求日志
     * @param int      $startTime
     * @param Request  $request
     * @param Response $response
     * @return array
     */
    public function sendNetLog(int $startTime, Request $request, Response $response): array {
        $type = 'net';
        $common = $this->buildCommonPart($type, $startTime);
        $extra = [
            'data' => [
                'request'  => [
                    'url'    => $request->getUri(),
                    'method' => $request->getMethod(),
                    'header' => $request->headers->all(),
                    'param'  => $request->all(),
                    'ip'     => $request->getClientIps(),
                ],
                'response' => [
                    'status_code' => $response->getStatusCode(),
                    'header'      => $response->headers->all(),
                    'body'        => json_decode($response->content(), true)
                ],
            ],
        ];
        return array_merge($common, $extra);
    }

    /**
     * 构造公共部分
     * @param string    $type
     * @param int|float $startTime
     * @return array
     */
    private function buildCommonPart(string $type, int $startTime = LARAVEL_START): array {
        return [
            'uuid'       => $this->uniContextRepo->getUuid(),
            'type'       => $type,
            'user_id'    => $this->userId,
            'start_time' => $startTime,
            'end_time'   => microtime(true),
        ];
    }
}
