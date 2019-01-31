<?php

namespace App\Notifications\player;

use App\Model\User ;
use App\Model\Challenge ;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AcceptRejectChallenge extends Notification
{
    use Queueable;

    public $challenge ;
    public $creator ; // notification creator
    public $user ; // notification reciver
    public $status ;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Challenge $challenge, $status)
    {
        $this->challenge = $challenge ;
        $this->creator = $challenge->candidate;
        $this->user = $challenge->creator;
        $this->status = $status ;
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
        return (new MailMessage)->view('player.emails.pages.AcceptRejectChallenge', 
                                        ['creator' => $this->creator,
                                         'challenge' => $this->challenge,                                        
                                         'user' => $this->user,
                                         'status' => $this->status,
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
            'ar'                    => $this->status == 'accept' ? "وافق على التحدي الخاص برياضة " . $this->challenge->challengeSport->ar_sport_name : "رفض التحدي الخاص برياضة " . $this->challenge->challengeSport->ar_sport_name,
            'en'                    => $this->status == 'accept' ? 'accept the challenge of ' . $this->challenge->challengeSport->en_sport_name : 'refuse the challenge of ' . $this->challenge->challengeSport->en_sport_name,
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
            'ar'                    => $this->status == 'accept' ? "وافق على التحدي الخاص برياضة " . $this->challenge->challengeSport->ar_sport_name : "رفض التحدي الخاص برياضة " . $this->challenge->challengeSport->ar_sport_name,
            'en'                    => $this->status == 'accept' ? 'accept the challenge of ' . $this->challenge->challengeSport->en_sport_name : 'refuse the challenge of ' . $this->challenge->challengeSport->en_sport_name,
            'user_url'              => '/profile/' . sm_crypt($this->creator->id),
            'user_img'              => !empty($this->creator->user_img) ? $this->creator->user_img : ''  ,
            'user_name'             => $this->creator->name ,
            'taraget_url'           => '/Challenge/Show/' . sm_crypt($this->challenge->id),
        ]);
    }
}
