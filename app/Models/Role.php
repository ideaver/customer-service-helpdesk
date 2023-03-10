<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $table = 'roles';

    protected $primaryKey = 'role_id';

    public $timestamps = true;

    public $incrementing = true;

    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
