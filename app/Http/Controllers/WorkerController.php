<?php

namespace App\Http\Controllers;

use App\Events\WorkerEvent;
use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function index()
    {
        $workers = Worker::all();
        return view('workers.index', compact('workers'));
    }

    public function create()
    {
        return view('workers.create');
    }

    public function store(Request $request)
    {
        // Save the image and message
        $image_path = $request->file('image_path')->store('worker_images', 'public');

        $worker = Worker::create([
            'name' => $request->name,
            'image_path' => $image_path,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
        ]);

        broadcast(new WorkerEvent($worker))->toOthers();

        return redirect()->route('workers.index');

    }
}
