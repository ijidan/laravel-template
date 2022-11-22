<?php

namespace App\Repository;


/**
 * 全局上下文
 * Class UniContextRepo
 * @package App\Http\Repository
 */
class UniContextRepo {

    private string $uuid;

    /**
     * 克隆
     */
    public function __construct() {
        $this->uuid = uuid_create(UUID_TYPE_TIME);
    }

    /**
     * @return string
     */
    public function getUuid(): string {
        return $this->uuid;
    }
}
