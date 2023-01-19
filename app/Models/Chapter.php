<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property-read Book $book
 * @property-read User $user
 * @mixin IdeHelperChapter
 */
class Chapter extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'slug', 'image', 'description', 'book_id', 'user_id'];

    /**
     * @return BelongsTo
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
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
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
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
