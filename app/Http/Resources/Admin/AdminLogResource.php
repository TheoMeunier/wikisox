<?php

namespace App\Http\Resources\Admin;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;
use Spatie\Activitylog\Models\Activity;

/**
 * @property-read User $causer
 */
class AdminLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        /* @var Activity $this */
        return [
            'id' => $this->id,
            /* @phpstan-ignore-next-line  */
            'event'    => $this->event,
            'username' => $this->causer->name ?? 'Server',
            /* @phpstan-ignore-next-line  */
            'subject_name' => $this->subject->name,
            'created_at'   => Carbon::parse($this->created_at)->format('d/m/Y'),
            'updated_at'   => Carbon::parse($this->updated_at)->format('d/m/Y'),
        ];
    }
}
