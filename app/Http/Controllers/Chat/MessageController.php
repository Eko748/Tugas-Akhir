<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Database;

class MessageController extends Controller
{
    protected $firebase;

    public function __construct(Database $firebase)
    {
        $this->firebase = $firebase;
    }

    public function index(Request $request)
    {
        $messages = Message::where(function ($query) use ($request) {
            $query->where('sender_id', $request->user()->id)
                  ->where('receiver_id', $request->receiver_id);
        })->orWhere(function ($query) use ($request) {
            $query->where('sender_id', $request->receiver_id)
                  ->where('receiver_id', $request->user()->id);
        })->get();

        $data = [
            "parent" => "Chat",
            "child" => "coba",
            // "receiver" =>  $receiver->id,
            "messages" => $messages,
        ];

        return view('pages.chat.index', $data);
    }

    public function store(Request $request)
    {
        $message = Message::create([
            'sender_id' => $request->user()->id,
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
        ]);

        $this->firebase->getReference('messages')->push([
            'sender_id' => $message->sender_id,
            'receiver_id' => $message->receiver_id,
            'content' => $message->content,
        ]);

        return redirect()->back();
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

    // public function store(Request $request)
    // {
    //     $message = Message::create([
    //         'sender_id' => Auth::user()->id,
    //         'receiver_id' => $request->receiver_id,
    //         'message' => $request->message
    //     ]);

    //     return response()->json($message);
    // }
}
