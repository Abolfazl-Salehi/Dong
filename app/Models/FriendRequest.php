<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
    protected $guarded = [];


    public function sender()
{
    return $this->belongsTo(User::class, 'sender_id');
}

}
