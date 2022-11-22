<?php

namespace App\Facades;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Facade as IlluminateFacade;
use App\Repository\ResponseRepo;

/**
 * @method static JsonResponse|JsonResource accepted($data = null, string $message = '', string $location = '')
 * @method static JsonResponse|JsonResource created($data = null, string $message = '', string $location = '')
 * @method static JsonResponse noContent(string $message = '')
 * @method static JsonResponse|JsonResource localize(int $code = 200, array $headers = [], int $option = 0)
 * @method static JsonResponse|JsonResource ok(string $message = '', int $code = 200, array $headers = [], int $option = 0)
 * @method static JsonResponse|JsonResource success($data = null, string $message = '', int $code = 200, array $headers = [], int $option = 0)
 * @method static JsonResponse errorBadRequest(?string $message = '')
 * @method static JsonResponse errorUnauthorized(string $message = '')
 * @method static JsonResponse errorForbidden(string $message = '')
 * @method static JsonResponse errorNotFound(string $message = '')
 * @method static JsonResponse errorMethodNotAllowed(string $message = '')
 * @method static JsonResponse errorInternal(string $message = '')
 * @method static JsonResponse fail(string $message = '', int $code = 500, $errors = null, array $header = [], int $options = 0)
 * @see \App\Repository\ResponseRepo
 */
class Response extends IlluminateFacade
{
    protected static function getFacadeAccessor(): string {
        return ResponseRepo::class;
    }
}
