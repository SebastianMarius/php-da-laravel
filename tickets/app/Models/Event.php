<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'image_url',
        'stripe_product_id',
        'stripe_price_id',
        'location',
        'description',
        'ticket_price',
    ];

    public $timestamps = false;

    // Assuming there are relationships with speaker, partner, and sponsor
    protected $attributes = [
        'image_url' => 'default_image.jpg',
    ];

    public function partners()
    {
        return $this->belongsToMany(Partners::class);
    }

    public function sponsors() {
        return $this->belongsToMany(Sponsors::class);
    }

    public function speakers() {
        return $this->belongsToMany(Speakers::class);
    }
    
  
}