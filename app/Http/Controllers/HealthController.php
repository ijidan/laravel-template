<?php

namespace App\Http\Controllers;

use App\Facades\Response;
use App\Models\User;
use Illuminate\Support\Facades\Log;


/**
 * 健康检查
 * Class HealthController
 * @package App\Http\Controllers
 */
class HealthController extends BaseController {

    /**
     * ping
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function ping() {
        $users=User::all();
        Log::info('info',$users->toArray());
        return Response::ok();
    }

}
