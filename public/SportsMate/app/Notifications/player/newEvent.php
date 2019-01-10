<?php

namespace App\Notifications\player;

use App\Model\User ;
use App\Model\Event ;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class newEvent extends Notification 
{
    use Queueable;

    public $event ;
    public $creator ;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $creator, Event $event)
    {
        $this->event = $event ;
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
        return ['database', 'broadcast'];
        //return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->view('player.emails.pages.nawEvent', 
                                        ['creator' => $this->creator,
                                         'event' => $this->event
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
            'ar'                    => 'أضاف حدث جديد في رياضة '. $this->event->eventSport->ar_sport_name,
            'en'                    => 'add new event ' . $this->event->eventSport->en_sport_name,
            'user_url'              => '/profile/' . sm_crypt($this->creator->id),
            'user_img'              => !empty($this->creator->user_img) ? $this->creator->user_img : ''  ,
            'user_name'             => $this->creator->name ,
            'taraget_url'           => '/Event/Show/' . sm_crypt($this->event->id),
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
            'ar'                    => 'أضاف حدث جديد في رياضة '. $this->event->eventSport->ar_sport_name,
            'en'                    => 'add new event ' . $this->event->eventSport->en_sport_name,
            'user_url'              => '/profile/' . sm_crypt($this->creator->id),
            'user_img'              => !empty($this->creator->user_img) ? $this->creator->user_img : ''  ,
            'user_name'             => $this->creator->name ,
            'taraget_url'           => '/Event/Show/' . sm_crypt($this->event->id),
        ]);
    }
}
