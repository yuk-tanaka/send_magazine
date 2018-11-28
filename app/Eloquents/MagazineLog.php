<?php

namespace App\Eloquents;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MagazineLog extends Model
{
    use GetTableColumns;

    /** @var array */
    protected $dates = [
        'send_at',
        'created_at',
        'updated_at',
    ];

    /** @var array */
    protected $fillable = [
        'title',
        'description',
        'footer',
        'send_at',
    ];

    /**
     * @return HasMany
     */
    public function magazineUserLogs(): HasMany
    {
        return $this->hasMany(MagazineUserLog::class);
    }

    /**
     * @return string
     */
    public function getShortTitleAttribute(): string
    {
        return str_limit($this->title, 100, '…');
    }

    /**
     * htmlのタグ途中で切れる可能性もある
     * @return string
     */
    public function getShortDescriptionAttribute(): string
    {
        return str_limit($this->description, 50, '…');
    }

    /**
     * htmlのタグ途中で切れる可能性もある
     * @return string
     */
    public function getShortFooterAttribute(): string
    {
        return str_limit($this->footer, 50, '…');
    }
}
