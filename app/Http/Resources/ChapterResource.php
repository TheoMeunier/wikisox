<?php

namespace App\Http\Resources;

use App\Models\Chapter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ChapterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     */
    public function toArray($request): array
    {
        /** @var Chapter $this */
        return [
            'id'          => $this->id,
            'name'        => Str::limit($this->name, 20),
            'slug'        => $this->slug,
            'description' => Str::limit($this->description, 60),
            'image'       => $this->image,
            'username'    => $this->user->name,
            'created_at'  => Carbon::parse($this->created_at)->diffForHumans(),
            'url'         => route('book.index'),
            'like'        => $this->like,
        ];
    }
}
