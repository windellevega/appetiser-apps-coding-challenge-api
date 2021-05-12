<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['event_name'];

    public function eventDates()
    {
        return $this->hasMany(EventDate::class);
    }

    public function getEventDatesArrayAttribute()
    {
        return $this->eventDates->pluck('event_date');
    }
}
