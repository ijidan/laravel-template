<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as RoutingController;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends RoutingController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
