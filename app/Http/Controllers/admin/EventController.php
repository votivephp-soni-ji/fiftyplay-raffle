<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('event.index', compact('events'));
    }

    public function create()
    {
        return view('event.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_title' => 'required|string|max:255',
            'ticket_price' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'draw_time' => 'nullable|date|after:end_date',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'rules' => 'nullable|file|mimes:pdf,docx,txt|max:4096',
            'max_tickets_per_user' => 'required|integer|min:1',
        ]);

        $data = [
            'title' => $request->event_title,
            'description' => $request->description,
            'ticket_price' => $request->ticket_price,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'draw_time' => $request->draw_time,
            'cause' => $request->cause,
            'max_tickets_per_user' => $request->max_tickets_per_user,
            'created_by' => auth()->id(),
        ];

        //dd($data);

        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')?->store('event_banners', 'public');
            $data['banner'] = $bannerPath;
        }


        if ($request->hasFile('rules')) {
            $rulesPath  = $request->file('rules')?->store('event_rules', 'public');
            $data['rules'] = $rulesPath;
        }
        Event::create($data);

        return redirect()->route('event.index')->withSuccess("Event Created.");
    }
}
