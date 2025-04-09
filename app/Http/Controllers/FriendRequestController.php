<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\FriendRequest;
use Illuminate\Http\Request;

class FriendRequestController extends Controller
{

    public function create(Request $request)
    {
        $sender = auth()->user();

        $sender->load(['friendsOf', 'friends']);

        $receiver_id = $request->get('receiver_id');

        $request = FriendRequest::query()->where('sender_id', $sender->id);

        if (!$receiver_id) {

            return response()->json([
                'message' => 'reciver_id is required'
            ]); 
        }

        foreach ($sender->friendsOf as $friend) {

            if ($receiver_id == $friend->id) {

                return response()->json([
                    'message' => 'you are alredy Friend!'
                ]);
            }

        }

        foreach ($sender->friends as $friend) {

            if ($receiver_id == $friend->id) {

                return response()->json([
                    'message' => 'you are alredy Friend!'
                ]);
            }

        }

        FriendRequest::query()->create([
            'sender_id' =>    $sender->id,
            'receiver_id' => $receiver_id,
            'status' => 'pending'
        ]);

        return response()->json([
            'massage' => 'succes.'
        ]);
    }
}
