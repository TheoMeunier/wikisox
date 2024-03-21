<?php

namespace App\Models;

use App\Services\Parser\ParserMarkdown;
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
 *
 * @mixin IdeHelperPage
 */
class Page extends Model
{
    use HasFactory;
    use LogsActivity;
    use SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'content',
        'chapter_id', 'user_id',
    ];

    protected $hidden = ['user_id', 'chapter_id'];

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }

    public function getLikeAttribute(): bool
    {
        return ! is_null($this->likes->first());
    }

    public function getParseContentAttribute(): string
    {
        $parser = new ParserMarkdown();

        return $parser->markdown($this->content);
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable')
            ->where('user_id', auth()->id());
    }

    /**
     * Get the model user.
     * Relationship with \App\Models\User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUrlAttribute(): string
    {
        return route('page.show', [
            'slug'        => $this->chapter->book->slug,
            'slugChapter' => $this->chapter->slug,
            'slugPage'    => $this->slug,
        ]);
    }

    public function getActivityLogOptions(): LogOptions
    {
        $logOption = new LogOptions();

        return $logOption->logAll()->logOnlyDirty();
    }
}
