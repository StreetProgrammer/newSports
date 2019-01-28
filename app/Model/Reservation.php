<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'R_playground_owner_id',
        'R_playground_id',
        'R_creator_id',
        'R_event_id',
        'code',
        'R_date',
        'R_day',
        'R_from',
        'R_to',
        'R_JQueryFrom',
        'R_JQueryTo',
        'R_price_per_hour',
        'R_hour_count',
        'R_total_price',
        'R_payment_status',
        'clubPaid',
        'resOwner',
        'reservedBy',
    ];

    /**
     * Get the club of that Reservation.
     */
    public function club()
    {
        return $this->belongsTo(User::class, 'R_playground_owner_id')->withDefault();
    }

    /**
     * Get the playground of that Reservation.
     */
    public function playground()
    {
        return $this->belongsTo(Playground::class, 'R_playground_id')->withDefault();
    }

    /**
     * Get the creator user of that Reservation.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'R_creator_id')->withDefault();
    }

    /**
     * Get the event of that Reservation.
     */
    public function event()
	{
		return $this->belongsTo(Event::class, 'R_event_id')->withDefault();
	}

    /**
     * Get the Day of that Reservation.
     */
    public function day()
    {
        return $this->belongsTo(Day::class, 'R_day', 'day_id')->withDefault();
    }

    /**
     * Get the start time ( hour ) of that Reservation.
     */
    public function from()
    {
        return $this->belongsTo(Hour::class, 'R_from', 'hour_id')->withDefault();
    }

    /**
     * Get the end time ( hour ) of that Reservation.
     */
    public function to()
    {
        return $this->belongsTo(Hour::class, 'R_to', 'hour_id')->withDefault();
    }
}
