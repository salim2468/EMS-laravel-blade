<?php

namespace App\Http\Controllers;

use App\Events\AnnouncementBroadcast;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function create()
    {
        return view('admin.announcement.create');
    }

    public function store()
    {
        return redirect()->route('admin.announcement.create')->with('success', 'Permission created successfully!');
    }

    public function broadcast(Request $request)
    {
        broadcast(new AnnouncementBroadcast($request->get('message')))->toOthers();

        return view('components.announcement-message', ['message' => $request->get('message')]);
    }

    public function receive(Request $request)
    {
        return view('components.announcement-message', ['message' => $request->get('message')]);
    }
}
