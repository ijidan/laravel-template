<?php

namespace App\Http\Resources;

/**
 * Class UserResource
 */
class UserResource extends BaseJsonResource {

    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array {
        return [
            'name'              => (string)$this->name,
            'email'             => (string)$this->email,
            'email_verified_at' => $this->ymd($this->email_verified_at),
            'password'          => (string)$this->password,
            'remember_token'    => (string)$this->remember_token,
            'created_at'        => $this->ymd($this->created_at),
            'updated_at'        => $this->ymd($this->updated_at),
            'mobile'            => (string)$this->mobile,
            'deleted_at'        => $this->ymd($this->deleted_at),
        ];
    }
}
