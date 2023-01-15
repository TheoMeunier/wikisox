<?php

namespace App\Http\Resources\Admin;

use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminChapterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        /* @var Book $this */
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'slug'        => $this->slug,
            'description' => $this->description,
            'image'       => $this->image,
            'username'    => $this->user->name,
            /* @phpstan-ignore-next-line  */
            'book'       => $this->book->name,
            'created_at' => Carbon::parse($this->created_at)->format('d/m/Y'),
            'updated_at' => Carbon::parse($this->updated_at)->format('d/m/Y'),
            'url'        => route('admin.chapters.index').'/'.$this->slug.'/edit',
            'like'       => $this->like,
        ];
    }
}
