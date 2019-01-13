<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\MailResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email',
        'slug',
        'user_img',
        'password',
        'type',
        'club_id',
        'user_is_active',
        'our_is_active',
        'active_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordNotification($token));
    }

    //###########################################################
    /**
     * used to allow advanced seaarch in [User] Model
     */
    public function scopeFilter($query, QueryFilter $filters)
    {
        return $filters->apply($query) ;
    }
    //###########################################################
//////////////////////////////////////////// As A Player ////////////////////////////////

    
    /**
     * Get the playerProfile record associated with the user.
     */
    public function playerProfile()
    {
        return $this->hasOne(playerProfile::class, 'p_user_id');
    }

    /**
     * Get the vacant days for the user.
     */
    public function vacancies()
    {
        return $this->hasMany(vacantTime::class, 'v_p_user_id');
    }

     /**
     * The sports that belong to the user.
     */
     public function sports()
    {
        return $this->belongsToMany(Sport::class)
                    ->withPivot('as_player', 'as_trainer', 'as_referee','RateInSport')
                    ->as('sportUserInfo')
                    ->withTimestamps();
    }


    /**
     * The sports that belong to the user.
     */
     public function appliedEvents()
    {
        return $this->belongsToMany(Event::class)
                    ->withPivot('as_player', 'as_trainer', 'as_referee')
                    ->as('appliedEventsInfo')
                    ->withTimestamps();
    }


    /**
     * Get the Challenges created by this user .
     */
    public function createdChallenges()
    {
        return $this->hasMany(Challenge::class, 'C_creator_id');
    }

    /**
     * The challenges was invited to !!
     */
     public function challengeEvents()
    {
        return $this->hasMany(Challenge::class, 'C_candidate_id');
    }

    /**
     * Get the Events created by this user .
     */
    public function createdEvents()
    {
        return $this->hasMany(Event::class, 'E_creator_id');
    }

    /**
     * Get the Events this user accepted .
     */
    public function candidatedEvents()
    {
        return $this->hasMany(Event::class, 'E_candidate_id');
    }

    /**
     * Get the SubEvents created by this user .
     */
    public function createdSubEvents()
    {
        return $this->hasMany(SubEvent::class, 'S_E_creator_id');
    }

    /**
     * Get the SubEvents this user accepted .
     */
    public function candidatedSubEvents()
    {
        return $this->hasMany(SubEvent::class, 'S_E_candidate_id');
    }


    /**
     * Get the player Reservations for the user  .
     */
    public function PlayerReservations()
    {
        return $this->hasMany(Reservation::class, 'R_creator_id');
    }

    public function AddEvent()
    {

    }


//////////////////////////////////// As A Club //////////////////////////////////////////////////////

    /**
     * Get the club Profile record associated with the user.
     */
    public function clubProfile()
    {
        return $this->hasOne(clubProfile::class, 'c_user_id');
    }


    /**
     * Get the clubBranches for the user of club type post.
     */
    public function clubBranches()
    {
        return $this->hasMany(clubBranche::class, 'c_b_user_id');
    }

    /**
     * Get the club playgrounds for the user of club type post.
     */
    public function clubPlaygrounds()
    {
        return $this->hasMany(Playground::class, 'c_user_id');
    }

    /**
     * Get the club Reservations for the user of club .
     */
    public function clubReservation()
    {
        return $this->hasMany(Reservation::class, 'R_playground_owner_id');
    }


    /**
     * function to add a branch to that club.
     */
    public function addBranch($request)
      {
        //'c_b_user_id', 'c_b_name', 'c_b_phone', 'c_b_address','c_b_img',
          clubBranches::create([

                        'c_b_user_id'   => $this->id,
                        'c_b_name'      => $request['c_b_name'],
                        'c_b_phone'     => $request['c_b_phone'],
                        'c_b_address'   => $request['c_b_address'],
                    ]);

          return back();
      }

//////////////////////////////////////// As A Club Admin / Manager ///////////////////////////////////////
    /**
     * Get the club of the user where user is [ admin / manager ] .
     */
    public function club()
    {
        return $this->belongsTo(clubProfile::class, 'c_user_id', 'club_id')->withDefault();
    }

    /**
     * The playgrounds that belong to the user [ manager ].
     */
     public function playgrounds()
    {
        return $this->belongsToMany(Playground::class)
                    ->withPivot('active', 'reservations', 'tobeuse')
                    ->as('UserPlaygrounds')
                    ->withTimestamps();
    }
}
