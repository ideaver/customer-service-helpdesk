<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    use SoftDeletes;

    protected $table = 'chats';

    protected $primaryKey = 'chat_id';

    public $timestamps = true;

    public $incrementing = true;

    protected $guarded = [];

    public function created_by_user()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }
}
