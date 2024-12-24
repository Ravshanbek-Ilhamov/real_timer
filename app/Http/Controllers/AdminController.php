<?php

namespace App\Http\Controllers;

use App\Events\CountingMessages;
use App\Events\GetMessagesEvent;
use App\Events\SwitchTheStatus;
use App\Models\Message;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){

        $messages = Message::all();

        $sentMessages = Message::where('status', 'sent')->count();
        broadcast(new GetMessagesEvent($sentMessages))->toOthers();

        return view('admin.index', compact('messages'));
    }

    public function switchMessageStatus($id)
    {
        $message = Message::find($id);
        if ($message) {
            $message->status = 'read';
            $message->save();
        }

        $sentMessages = Message::where('status', 'sent')->get();
        broadcast(new SwitchTheStatus($sentMessages))->toOthers();
        broadcast(new CountingMessages($sentMessages->count()))->toOthers();

        return redirect()->route('admin');
    }

    public function iconClick(){
        $sentMessages = Message::where('status', 'sent')->count();
        broadcast(new GetMessagesEvent($sentMessages))->toOthers();
    }
    
}
