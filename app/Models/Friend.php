<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $guarded = [];



    public static function areFriends($user1, $user2)
    {
        return self::whereIn('user_1', [$user1, $user2])
            ->whereIn('user_2', [$user1, $user2])
            ->whereColumn('user_1', '!=', 'user_2')
            ->exists();
    }
}
