<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    //
    public function sendMessage(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'message' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $receiver = User::where('name', $request->name)->first();
        if (!$receiver) {
            return response()->json(['error' => 'Destinataire introuvable.'], 404);
        }
        $user = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $receiver->id,
            'content' => $request->message,

        ]);
        $user->save();

        return view('sendMessage', ['success' => 'Message envoyé avec succès.']);
    }

    public function getMessage()
    {
        $userId = Auth::id();
        $messages = Message::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with('sender', 'receiver')
            ->get();

        return response()->json(['messages' => $messages, 'userId' => Auth::id()]);
    }
    public function countUnreadMessages()
    {
        $userId = Auth::id();
        $count = Message::where('receiver_id', $userId)
            ->where('is_read', false)
            ->count();

        return response()->json(['unreadCount' => $count]);
    }
    public function markAsRead()
    {
        $userId = Auth::id();
        Message::where('receiver_id', $userId)->where('is_read', false)->update(['is_read' => true]);
        return response()->json(['success' => 'Messages marked as read']);
    }


}

