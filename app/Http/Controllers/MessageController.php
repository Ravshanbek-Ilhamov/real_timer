<?php

namespace App\Http\Controllers;

use App\Events\CountingMessages;
use App\Events\GetMessagesEvent;
use App\Events\MessageEvent;
use App\Events\SwitchTheStatus;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all();
        
        $sentMessages = Message::where('status', 'sent')->count();
        broadcast(new CountingMessages($sentMessages))->toOthers();

        return view('messages.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $image_path = $request->file('image_path')->store('images', 'public');
    
        $message = Message::create([
            'message' => $request->message,
            'image_path' => $image_path,
        ]);

        broadcast(new MessageEvent($message))->toOthers();

        $sentMessages = Message::where('status', 'sent')->count();
        broadcast(new CountingMessages($sentMessages))->toOthers();

        $sentMessages = Message::where('status', 'sent')->get();
        broadcast(new SwitchTheStatus($sentMessages))->toOthers();

        return redirect()->route('messages.index');
    }
    
}
