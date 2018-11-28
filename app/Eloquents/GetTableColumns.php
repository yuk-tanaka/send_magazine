<?php

namespace App\Eloquents;

use Illuminate\Support\Collection;

trait GetTableColumns
{
    /**
     * テーブル名を取得する
     * $hidden登録のテーブルは取得しない
     * https://laravel-tricks.com/tricks/get-table-column-names-as-array-from-eloquent-model
     * ほかに良い解決法があれば
     * @return Collection
     */
    public function getTableColumns(): Collection
    {
        $columns = $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());

        return collect($columns)->diff($this->hidden)->flatten();
    }
}