<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Role extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'description'];

    /**
     * @return MorphToMany
     */
    public function relationSystem(): MorphToMany
    {
        return $this->morphedByMany(PermissionSystem::class, 'rolesable');
    }

    /**
     * @return MorphToMany
     */
    public function relationResource(): MorphToMany
    {
        return $this->morphedByMany(PermissionResource::class, 'rolesable');
    }

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->HasOne(User::class);
    }
}
