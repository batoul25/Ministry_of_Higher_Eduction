<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BreakingNewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'image' => $this->filename,
            'path'  => $this->path,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}
