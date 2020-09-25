<?php

namespace App\Http\Resources\user;

use Illuminate\Http\Resources\Json\JsonResource;
 use App\Http\Resources\userPersonas\UserPersonaResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'email'=> $this->email,
            'firstName'=> $this->firstName,
            'lastName'=> $this->lastName,
            'rfc'=> $this->rfc,
            'curp'=> $this->curp,
            'userpersona'=> UserPersonaResource::collection($this->userpersonas),
            'role'=> RoleResource::collection($this->user_role),
            'doc_user'=> DocResource::collection($this->doc_user_req),
            'user_notifica'=> NotificaResource::collection($this->user_notifica),
            'verification_profile'=> VerificaResource::collection($this->user_verifica),
        ];
    }
}
