<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Response;

/**
 * 用户相关
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends BaseController
{
    /**
     * 登录
     * @return Response
     */
    public function login(): Response {
        $user=User::query()->findOrFail(1000);
        $paginate=User::paginate();
        $data=UserResource::collection($paginate);
        $content=[
            'data'=> $data
        ];
        $response = new Response($content, Response::HTTP_OK, []);
        return $response;

    }

    public function info(){
        $paginate=User::paginate();
        return UserResource::collection($paginate);
    }

    /**
     * @return Response
     */
    public function all(): Response {
        $users=User::all();
    }
}
