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
 * @property-read User $user
 * @mixin IdeHelperBook
 */
class Book extends Model
{
    use HasFactory;
    use LogsActivity;
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'slug', 'image', 'description', 'user_id'];

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class);
    }

    public function getLikeAttribute(): bool
    {
        return ! is_null($this->likes->first());
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable')
            ->where('user_id', auth()->id());
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        $logOption = new LogOptions();

        return $logOption->logAll()->logOnlyDirty();
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($book) {
            foreach ($book->chapters as $chapter) {
                $chapter->pages()->delete();
            }

            $book->chapters()->delete();
        });
    }
}
