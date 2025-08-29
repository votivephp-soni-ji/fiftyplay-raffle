<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();

        // Filter by status
        $status = $request->get('status'); // active | upcoming | past
        $today = Carbon::now();

        if ($status === 'active') {
            $query->where('start_date', '<=', $today)
                ->where('end_date', '>=', $today);
        } elseif ($status === 'upcoming') {
            $query->where('start_date', '>', $today);
        } elseif ($status === 'past') {
            $query->where('end_date', '<', $today);
        }

        // Filter by sport (assuming "cause" is your category, you can rename later)
        if ($request->has('sport')) {
            $query->where('cause', 'like', '%' . $request->get('sport') . '%');
        }

        // Filter by location (if you have location column)
        if ($request->has('location')) {
            $query->where('location', 'like', '%' . $request->get('location') . '%');
        }

        // Filter by date range
        if ($request->has(['start_date', 'end_date'])) {
            $query->whereBetween('start_date', [
                $request->get('start_date'),
                $request->get('end_date')
            ]);
        }

        // Search by title/description
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });
        }

        $events = $query->latest()->paginate(10);
    }
    public function create(EventRequest $request)
    {

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'ticket_price' => $request->ticket_price,
            'start_date' => Carbon::parse($request->start_date)->format('Y-m-d'),
            'end_date' => Carbon::parse($request->end_date)->format('Y-m-d'),
            'draw_time' => $request->draw_time,
            'cause' => $request->cause ?? null,
            'max_tickets_per_user' => $request->max_tickets_per_user,
            'created_by' => auth()->id()
        ];

        $event = Event::create($data);

        if ($request->hasFile('banners')) {
            foreach ($request->file('banners') as $banner) {
                $path = $banner->store('event_banners', 'public');
                $event->banners()->create(['banner' => $path]);
            }
        }

        // ✅ Upload rules file (single)
        if ($request->hasFile('rules')) {
            $rulesPath = $request->file('rules')->store('event_rules', 'public');
            $event->rules = $rulesPath;
            $event->save();
        }

        return response()->json(['message' => 'Event created', 'event' => $event]);
    }

    public function pause(Event $event)
    {
        $event->update(['status' => 'paused']);
        return response()->json(['status' => true, 'message' => 'Event paused']);
    }

    public function resume(Event $event)
    {
        $event->update(['status' => 'active']);
        return response()->json(['status' => true, 'message' => 'Event resumed']);
    }
}
