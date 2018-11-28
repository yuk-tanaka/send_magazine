<?php

namespace App\Http\Resources\ResourceCollections;

use App\Http\Resources\MagazineLogResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;

class MagazineLogResourceCollection extends VueTableResourceCollection
{
    /**
     * @return Collection
     */
    protected function columns(): Collection
    {
        return parent::columns()->reject(function ($v) {
            return $v === 'created_at' || $v === 'updated_at';
        })->push('count');
    }

    /**
     * @return AnonymousResourceCollection
     */
    protected function data(): AnonymousResourceCollection
    {
        return MagazineLogResource::collection($this->collection);
    }
}