<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Activitylog\Models\Activity;

/**
 * @mixin IdeHelperActivityLog
 */
class ActivityLog extends Activity
{
    /**
     * @return MorphTo
     */
    public function subject(): MorphTo
    {
        if (config('activitylog.subject_returns_soft_deleted_models')) {
            /* @phpstan-ignore-next-line  */
            return $this->morphTo()->withTrashed();
        }

        return $this->morphTo();
    }
}
