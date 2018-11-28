<?php

namespace App\Http\Resources\ResourceCollections;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

abstract class VueTableResourceCollection extends ResourceCollection
{
    /**
     * TODO Optionsも含める
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'columns' => $this->columns(),
            'data' => $this->data(),
        ];
    }

    /**
     * @return Collection
     */
    protected function columns(): Collection
    {
        return $this->collection->first()->getTableColumns();
    }


    /**

     * @return AnonymousResourceCollection
     */
    abstract protected function data(): AnonymousResourceCollection;
}