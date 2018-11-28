<?php

namespace App\Eloquents;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MagazineUserLog extends Model
{
    use GetTableColumns;

    /** @var array */
    protected $casts = [
        'magazine_log_id' => 'integer',
    ];

    /** @var array */
    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * @return BelongsTo
     */
    public function magazineLog(): BelongsTo
    {
        return $this->belongsTo(MagazineLog::class);
    }
}
