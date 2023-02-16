<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thread extends Model
{
    use SoftDeletes;

    protected $table = 'threads';

    protected $primaryKey = 'thread_id';

    public $timestamps = true;

    public $incrementing = true;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(ThreadCategory::class, 'thread_category_id');
    }

    public function non_read_chat()
    {
        return $this->hasMany(Chat::class, 'thread_id')->whereNull('read_at');
    }

    public function user1()
    {
        return $this->belongsTo(User::class, 'user_id_1', 'user_id');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'user_id_2', 'user_id');
    }
}
