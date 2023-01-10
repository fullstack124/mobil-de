<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(Request $request, $id)
    {
        $chats = [];
        if ($id) {
            $conversation = Conversation::where(
                ['a' => auth()->id, 'b' => $id](),
            )->first();

            if ($conversation) {
                $chats = Chat::where("conversation_id", $conversation->id)->get();
            } else {
                $conversation = Conversation::Where(
                    ['b' => auth()->id, 'a' => $id()]
                )->first();
                if ($conversation) {
                    $chats = Chat::where("conversation_id", $conversation->id)->get();
                } else {
                    $chats = [];
                }
            }
        } else {
            $chats = [];
        }

        return response()->json([
            'success' => true,
            'chats' => $chats
        ]);
    }

    public function sendMessage(Request $request)
    {

        $conversation = Conversation::where(
            ['a' => auth()->id(), 'b' => $request->id]
        )->first();
        if ($conversation) {
            $chat = new Chat();
            $chat->user_id = auth()->id();
            $chat->conversation_id = $conversation->id;
            $chat->message = $request->message;
            $chat->save();
        } else {
            $conversation = Conversation::where(
                ['b' => auth()->id(), 'a' => $request->id]
            )->first();
            if ($conversation) {
                $chat = new Chat();
                $chat->user_id = auth()->id();
                $chat->conversation_id = $conversation->id;
                $chat->message = $request->message;
                $chat->save();
            } else {
                $conversation = Conversation::create([
                    'a' => auth()->id(),
                    'b' => $request->id,
                ]);
                $chat = new Chat();
                $chat->user_id = auth()->id();
                $chat->conversation_id = $conversation->id;
                $chat->message = $request->message;
                $chat->save();
            }
        }
    }
}
