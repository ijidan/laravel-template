<?php

namespace App\Http\Resources;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class BaseJsonResource extends JsonResource
{
    protected $notFoundMessage = '暂无数据';

    public function __construct($resource)
    {
        parent::__construct($resource);

        if (empty($this->resource)) {
            throw new HttpResponseException(response([
                    'code' => 404,
                    'errCode' => 0,
                    'msg' => $this->notFoundMessage,
                    'data' => [],
                ]
            ));
        }
    }

    /**
     * 格式化
     * @param Carbon|null $carbon
     * @return string
     */
    protected function ymd(Carbon $carbon=null): string {
        if(is_null($carbon)){
            return '';
        }
        return $carbon->format('Y-m-d H:i:s');
    }
}
