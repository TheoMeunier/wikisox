<?php

namespace App\Http\Resources;

use App\Models\Chapter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChapterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Chapter $this */
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'slug'        => $this->slug,
            'description' => $this->description,
            'image'       => $this->image,
            'username'    => $this->user->name,
            'created_at'  => Carbon::parse($this->created_at)->diffForHumans(),
            'url'         => route('book.index'),
            'like'        => $this->like,
        ];
    }
}
