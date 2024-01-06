<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Sponsors;
use App\Models\Speakers;
use App\Models\Partners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Product;
use Stripe\Price;
use Stripe\Stripe;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::info('Index method called.'); // Log an information message

        $events = Event::all();
        Log::info($events);
        return view('events.index', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $speakers = Speakers::all();
        $sponsors = Sponsors::all();
        $partners = Partners::all();
        
        return view('events.create', compact('speakers', 'sponsors', 'partners'));

    }
        /**

     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));


        $event = new Event;
        $event->title = $request->title;
        $event->start_date = $request->start_date;
        $event->start_time = $request->start_time;
        $event->end_date = $request->end_date;
        $event->end_time = $request->end_time;
        $event->location = $request->location;
        $event->description = $request->description;
        $event->tichet_price = $request->tichet_price *100;
        
    
        // Handle photo upload
        Log::info('dasss');
        Log::info($request->tichet_price);
        if ($request->hasFile('photo')) {
            Log::info('dadadada');
            $photo = $request->file('photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('photos'), $photoName);
            $event->photo_url = '/photos/' . $photoName;
        }

        Log::info('Event Title: ' . $event->title); // Add this line to check the event title


        $stripeProduct = Product::create([
            'name' => $event->title // Replace with your event name or title
            // Other product details if needed
        ]);
    
        // Create a price for the product in Stripe
        $stripePrice = Price::create([
            'product' => $stripeProduct->id,
            'unit_amount' => $request->tichet_price * 100, // Convert to cents
            'currency' => 'usd', // Replace with your desired currency
            // Other price details if needed
        ]);
    
        // Associate the Stripe Product ID and Stripe Price ID with your Event
        $event->stripe_product_id = $stripeProduct->id;
        $event->stripe_price_id = $stripePrice->id;
    
        $event->save();
    
        Log::info($request->input('speaker_ids')); // Add this line to check the event title
        // Attach speakers, sponsors, and partners
        $event->speakers()->sync($request->input('speaker_ids', []));
        $event->sponsors()->sync($request->input('sponsor_ids', []));
        $event->partners()->sync($request->input('partner_ids', []));
    
        // return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
         
        $urlu = url()->current();
        $segments = collect(explode('/', $urlu));
        $desiredSegment = $segments->reverse()->splice(1, 1)->first(); 

        $eventu_din_db = Event::find($desiredSegment);
        
        return view('events.edit', compact('eventu_din_db'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($eventId)
    {
        $event = Event::findOrFail($eventId);
         $event->delete();
          return redirect()->back();
    }
}
