<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index($id)
    {
        $receiver = User::find($id);
        $messages = Message::where(function ($query) use ($id) {
            $query->where('sender_id', Auth()->id())
                ->where('receiver_id', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('sender_id', $id)
                ->where('receiver_id', Auth()->id());
        })->orderBy("created_at", "DESC")->paginate(6);

        $data = [
            "parent" => "Chat",
            "child" => $receiver->name,
            "receiver" =>  $receiver->id,
            "messages" => $messages,
        ];

        return view('pages.chat.index', $data);
    }

    public function getAjax(Request $request, $id)
    {
            $receiver = User::find($id);
            $messages = Message::where(function ($query) use ($id) {
                $query->where('sender_id', Auth()->id())
                    ->where('receiver_id', $id);
            })->orWhere(function ($query) use ($id) {
                $query->where('sender_id', $id)
                    ->where('receiver_id', Auth()->id());
            })->orderBy("created_at", "DESC")->paginate(6);
            $data = [
                "receiver" => $receiver,
                "messages" => $messages,
            ];
            return response()->json($data);
        
    }

    public function store(Request $request)
    {
        $message = Message::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ]);

        return response()->json($message);
    }
}
