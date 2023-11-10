<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsFeedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'image'    => $this->filename ,
            'path'     => $this->path,
            'title'    => $this->title ,
            'place'    => $this->place ,
            'newsDate' => $this->newsDate,
            'order'    => $this->order,
        ];
    }
}
