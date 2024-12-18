<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all();
        return view('messages.index', compact('messages'));
    }

    public function store(Request $request)
    {
        // Save the image and message
        $image_path = $request->file('image_path')->store('images', 'public');
    
        $message = Message::create([
            'message' => $request->message,
            'image_path' => $image_path,
        ]);
    
        // Broadcast the event with the created message
        broadcast(new MessageEvent($message))->toOthers();
    
        return redirect()->route('messages.index');
    }
    
}
