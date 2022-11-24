<?php

namespace App\GraphQL\Queries;

use Illuminate\Support\Facades\Log;

final class UserByMobile
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        Log::info('aaa',$args);
        // TODO implement the resolver
    }
}
