<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasFactory;

    /**
     * Relación: Un rol puede tener muchos permisos.
     *
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return parent::permissions();
    }
}
