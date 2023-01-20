<?php

namespace App\Http\Resources\Admin;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var User $this */
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'email'      => $this->email,
            'verify'     => $this->email_verified_at,
            'edit'       => route('admin.users.edit', ['id' => $this->id]),
            'created_at' => Carbon::parse($this->created_at)->format('d/m/Y'),
            'updated_at' => Carbon::parse($this->updated_at)->format('d/m/Y'),
        ];
    }
}
