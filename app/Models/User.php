<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'users';

    protected $primaryKey = 'user_id';

    public $timestamps = true;

    public $incrementing = true;

    protected $guarded = [];

    protected $hidden = ['password', 'fcm_token', 'created_at', 'updated_at', 'deleted_at'];

    public function statusToText()
    {
        return $this->is_active == 1 ? 'Active' : 'Non-Active';
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
