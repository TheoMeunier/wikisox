<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property-read Chapter $chapter
 * @property-read Book $book
 * @property-read User $user
 * @mixin IdeHelperPage
 */
class Page extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $fillable = [
        'name', 'slug', 'content',
        'chapter_id', 'user_id',
    ];

    protected $hidden = ['user_id', 'chapter_id'];

    /**
     * @return BelongsTo
     */
    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }

    /**
     * @return bool
     */
    public function getLikeAttribute(): bool
    {
        return ! is_null($this->likes()->first());
    }

    /**
     * @return MorphMany
     */
    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * Get the model user.
     * Relationship with \App\Models\User.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return LogOptions
     */
    public function getActivityLogOptions(): LogOptions
    {
        $logOption = new LogOptions();

        return $logOption->logAll()->logOnlyDirty();
    }
}
