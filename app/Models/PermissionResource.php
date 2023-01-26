<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @mixin IdeHelperPermissionResource
 */
class PermissionResource extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'description'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return MorphToMany
     */
    public function roles(): MorphToMany
    {
        return $this->morphToMany(Role::class, 'rolesable');
    }
}
