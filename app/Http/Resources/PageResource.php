<?php

namespace App\Http\Resources;

use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     */
    public function toArray($request): array
    {
        /** @var Page $this */
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'slug'        => $this->slug,
            'description' => $this->content,
            'username'    => $this->user->name,
            'created_at'  => Carbon::parse($this->created_at)->diffForHumans(),
            'url'         => route('book.index'),
            'like'        => $this->like,
        ];
    }
}
