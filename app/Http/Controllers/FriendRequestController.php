<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\FriendRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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

    public function get_all(){
        
        $reciver=auth()->user();


    }


    public function update(Request $request,$id, FriendRequest $friend_request)
    {


        $receiver = auth()->user();

    // checking status
    $request->validate([
        'status' => 'required|in:accepted,rejected',
    ]);

    // finding id
    $friend_request = FriendRequest::findOrFail($id);

    // chekicng receiver
    if ($friend_request->receiver_id !== $receiver->id) {
        return response()->json(['message' => 'شما مجاز به تغییر این درخواست نیستید.'], 403);
    }

    $friend_request->status = $request->status;
    $friend_request->save();

    // accepting the request
    if ($request->status === 'accepted') {
        DB::table('friends')->insertOrIgnore([
            ['user_1' => $friend_request->sender_id, 'user_2' => $friend_request->receiver_id],
            ['user_2' => $friend_request->receiver_id, 'user_1' => $friend_request->sender_id],
        ]);
    }

    return response()->json(['message' => 'درخواست دوستی با موفقیت ' . $request->status . ' شد.']);








        
    }



    public function receivedRequests()
    {
        $user = auth()->user();
    
        $requests = FriendRequest::where('receiver_id', $user->id)
                        ->where('status', 'pending')
                        ->with('sender')
                        ->get();
    
        // no friend request
        if ($requests->isEmpty()) {
            return response()->json(['message' => 'درخواست دوستی وحود ندارد.'], 404);
        }
    
        return response()->json($requests);
    }
    

}
