<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function newMessages()
    {
        $messages = Message::where('sender_id', Auth::id())
            ->get();

        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $message = Message::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ]);

        return $this->getMessages();
    }
}
