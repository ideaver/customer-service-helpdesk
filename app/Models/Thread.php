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

    protected $hidden = ['updated_at', 'deleted_at'];

    public function topic()
    {
        return $this->belongsTo(ThreadTopic::class, 'thread_topic_id');
    }

    public function non_read_chat()
    {
        return $this->hasMany(Chat::class, 'thread_id')->whereNull('read_at')->orderBy('created_at', 'desc');
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
