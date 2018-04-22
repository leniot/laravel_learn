<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Administrator extends Model implements AuthenticatableContract
{
    use Authenticatable;

    /**
     * @var array
     */
    protected $fillable = [
        'login_name', 'password'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * 管理员-角色多对多关联
     * @return BelongsToMany
     */
    public function roles() : BelongsToMany
    {
        $pivotTable = 'role_administrators';

        $relatedModel = Role::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'administrator_id', 'role_id');
    }
}
