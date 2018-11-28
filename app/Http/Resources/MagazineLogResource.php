<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class MagazineLogResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'send_at' => $this->send_at->format('Y-m-d H:i'),
            'count' => $this->magazineUserLogs()->count(),
            'title' => $this->shortTitle,
            'description' => $this->shortDescription,
            'footer' => $this->shortFooter,
            'titleFull' => $this->title,
            'descriptionFull' => $this->description,
            'footerFull' => $this->footer,
        ];
    }

}