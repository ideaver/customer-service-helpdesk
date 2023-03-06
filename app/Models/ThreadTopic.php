<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThreadTopic extends Model
{
    use SoftDeletes;

    protected $table = 'thread_topics';

    protected $primaryKey = 'thread_topic_id';

    public $timestamps = true;

    public $incrementing = true;

    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
