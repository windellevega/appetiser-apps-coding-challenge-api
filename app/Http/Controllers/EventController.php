<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventStoreRequest;
use App\Models\Event;
use App\Models\EventDate;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = Event::latest()->first();

        if (!$event) {
            return abort(404);
        }

        // Get array of dates only e.g. ['2021-05-12', '2021-05-13']
        $eventDates = $event->eventDates()->pluck('event_date');
        $event->event_dates = $eventDates->all();

        return response()->json($event, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventStoreRequest $request)
    {
        $event = Event::create([
            'event_name' => $request->event_name
        ]);

        $event_dates = [];

        // Generate dates starting from event_date_from to event_date_to
        $datePeriod = CarbonPeriod::create($request->event_date_from, $request->event_date_to);  

        foreach($datePeriod as $date) {
            // Get the corresponding day of week for such date (0-6)
            $dayOfDate = date('w', strtotime($date));

            // Check if day of the date is in the event_days
            if (in_array($dayOfDate, $request->event_days)) {
                array_push($event_dates, [
                    'event_id'      => $event->id,
                    'event_date'    => $date
                ]);
            }
        }

        EventDate::insert($event_dates);

        // Get array of dates only e.g. ['2021-05-12', '2021-05-13']
        $eventDates = $event->eventDates()->pluck('event_date');
        $event->event_dates = $eventDates->all();

        return response()->json($event, 201);
    }
}
