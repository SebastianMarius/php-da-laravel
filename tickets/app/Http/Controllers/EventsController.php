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

     * Edits created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editStore(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));


        $event = Event::find($request->id);

        if ($event->title != $request->title)
            $event->title = $request->title;

        if ($event->start_date != $request->start_date)
            $event->start_date = $request->start_date;


        if($event->start_time != $request->start_time)
            $event->start_time = $request->start_time;
        
        if($event->end_date != $request->end_date)
            $event->end_date = $request->end_date;
        
        if($event->end_time != $request->end_time)
            $event->end_time = $request->end_time;


        if($event->location != $request->location)
            $event->location = $request->location;
        
        if($event->description != $request->description)
            $event->description = $request->description;

        if($event->tichet_price != $request->tichet_price*100)
            $event->tichet_price = $request->tichet_price *100;


        // Handle photo upload
        // Log::info($request);
        // Log::info($request->tichet_price);
        // $event->imageurl = $request->photo;
        // if ($request->hasFile('photo')) {
        //     $photo = $request->file('photo');
        //     $photoName = time() . '' . $photo->getClientOriginalName();

        //     if ($photo->move(public_path('photos'), $photoName)) {
        //         $event->photo_url = '/photos/' . $photoName;
        //         Log::info('Photo uploaded successfully. Photo URL: ' . $event->photo_url);
        //     } else {
        //         Log::error('Failed to move the photo.');
        //     }
        // }

        Log::info('Event Title: ' . $event->title); // Add this line to check the event title

        // retrieve Stripe Product
        $stripeProduct = Product::find($event->stripe_product_id);

        // Check if the product exists
        if ($stripeProduct) {
            // Update the title if it's different
            if ($stripeProduct->name != $event->title)
                $stripeProduct->name = $event->title; // Replace with the new title

            $stripeProduct->save(); // Save the changes

        } else { // if stripeProduct doesn't exist
            $newStripeProduct = Product::create([
                'name' => $event->title // Replace with your event name or title
                // Other product details if needed
            ]);
            $event->stripe_product_id = $newStripeProduct->id; // associate product ID with the event
        }
    
        // Retrieve Stripe Price
        $stripePrice = Price::find($event->stripe_price_id);

        // Check if the price exists
        if ($stripePrice) {
            // Update the stripe price if it's different
            if ($stripePrice->product != $stripeProduct->id)
                $stripePrice->product = $stripeProduct->id; // Replace with the new product id

            if ($stripePrice->unit_amount != $event->tichet_price)
                $stripePrice->unit_amount = $event->tichet_price;

            $stripePrice->save(); // Save the changes
            
        } else { // if stripe Price doesn't exist
            $newStripePrice = Price::create([
                'product' => $stripeProduct->id,
                'unit_amount' => $event->tichet_price, // Convert to cents
                'currency' => 'usd', // Replace with your desired currency
                // Other price details if needed
            ]);
            $event->stripe_price_id = $newStripePrice->id; // associate price ID with the event
        }
    
    
        $event->save();
    
        Log::info($request->input('speaker_ids')); // Add this line to check the event title

        // Attach speakers, sponsors, and partners
        $event->speakers()->sync($request->input('speaker_ids', []));
        $event->sponsors()->sync($request->input('sponsor_ids', []));
        $event->partners()->sync($request->input('partner_ids', []));
    
        // return redirect()->route('events.index')->with('success', 'Event edited successfully!');
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
        
        $speakers = Speakers::all();
        $sponsors = Sponsors::all();
        $partners = Partners::all();
        
        return view('events.edit', compact('eventu_din_db', 'speakers', 'sponsors', 'partners'));
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
