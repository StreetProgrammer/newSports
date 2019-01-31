<?php

namespace App\Notifications\player;

use App\Model\User ;
use App\Model\Challenge ;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class newChallenge extends Notification
{
    use Queueable;

    public $challenge ;
    public $creator ;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $creator, Challenge $challenge)
    {
        $this->challenge = $challenge ;
        $this->creator = $creator ;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['database'];
        return ['mail', 'database'];

    }

 /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->view('player.emails.pages.newChallenge', 
                                        ['creator' => $this->creator,
                                         'challenge' => $this->challenge
                                     ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'ar'                    => 'يتحداك في رياضة '. $this->challenge->challengeSport->ar_sport_name,
            'en'                    => 'Challenge you in ' . $this->challenge->challengeSport->en_sport_name,
            'user_url'              => '/profile/' . sm_crypt($this->creator->id),
            'user_img'              => !empty($this->creator->user_img) ? $this->creator->user_img : ''  ,
            'user_name'             => $this->creator->name ,
            'taraget_url'           => '/Challenge/Show/' . sm_crypt($this->challenge->id),
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'ar'                    => 'يتحداك في رياضة '. $this->challenge->challengeSport->ar_sport_name,
            'en'                    => 'Challenge you in ' . $this->challenge->challengeSport->en_sport_name,
            'user_url'              => '/profile/' . sm_crypt($this->creator->id),
            'user_img'              => !empty($this->creator->user_img) ? $this->creator->user_img : ''  ,
            'user_name'             => $this->creator->name ,
            'taraget_url'           => '/Challenge/Show/' . sm_crypt($this->challenge->id),
        ]);
    }
}
