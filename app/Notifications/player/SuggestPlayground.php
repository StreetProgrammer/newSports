<?php

namespace App\Notifications\player;

use App\Model\User ;
use App\Model\Event ;
use App\Model\Challenge ;
use App\Model\Playground ;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SuggestPlayground extends Notification
{
    use Queueable;

    public $eventId;
    public $eventType;
    public $event ;
    public $creator ;
    public $playground ;
    public $users ;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $creator, $eventId, $eventType, Playground $playground, User $users)
    {
        $this->eventType = $eventType ;
        $this->creator = $creator ;
        $this->playground = $playground ;
        $this->users = $users ;
        switch ($eventType) {
            case 'event':
               $this->event = Event::find($eventId);
                break;
            case 'challenge':
                $this->event = Challenge::find($eventId);
                break;
        }
        

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
        return (new MailMessage)->view('player.emails.pages.SuggestPlayground', 
                                        ['creator' => $this->creator,
                                         'eventType' => $this->eventType,
                                         'event' => $this->event,
                                         'playground' => $this->playground,
                                         'users' => $this->users,
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
        switch ($this->eventType) {
            case 'event':
                return [
                    'ar'                    => "اقترح الملعب ". $this->playground->c_b_p_name . " للحدث الخاص برياضة " . $this->event->eventSport->ar_sport_name,
                    'en'                    => 'suggest playground  ' . $this->playground->c_b_p_name .' for the event of ' . $this->event->eventSport->en_sport_name,
                    'user_url'              => '/profile/' . sm_crypt($this->creator->id),
                    'user_img'              => !empty($this->creator->user_img) ? $this->creator->user_img : ''  ,
                    'user_name'             => $this->creator->name ,
                    'taraget_url'           => '/Event/Show/' . sm_crypt($this->event->id),
                ];
                break;
            case 'challenge':
                return [
                    'ar'                    => "اقترح الملعب ". $this->playground->c_b_p_name . " للتحدي الخاص برياضة " . $this->event->challengeSport->ar_sport_name,
                    'en'                    => 'suggest playground  ' . $this->playground->c_b_p_name .' for the challenge of ' . $this->event->challengeSport->en_sport_name,
                    'user_url'              => '/profile/' . sm_crypt($this->creator->id),
                    'user_img'              => !empty($this->creator->user_img) ? $this->creator->user_img : ''  ,
                    'user_name'             => $this->creator->name ,
                    'taraget_url'           => '/Challenge/Show/' . sm_crypt($this->event->id),
                ];
                break;
        }
        
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {

        switch ($this->eventType) {
            case 'event':
                return new BroadcastMessage([
                    'ar'                    => "اقترح الملعب ". $this->playground->c_b_p_name . " للحدث الخاص برياضة " . $this->event->eventSport->ar_sport_name,
                    'en'                    => 'suggest playground  ' . $this->playground->c_b_p_name .' for the event of ' . $this->event->eventSport->en_sport_name,
                    'user_url'              => '/profile/' . sm_crypt($this->creator->id),
                    'user_img'              => !empty($this->creator->user_img) ? $this->creator->user_img : ''  ,
                    'user_name'             => $this->creator->name ,
                    'taraget_url'           => '/Event/Show/' . sm_crypt($this->event->id),
                ]);
                break;
            case 'challenge':
                return new BroadcastMessage([
                    'ar'                    => "اقترح الملعب ". $this->playground->c_b_p_name . " للتحدي الخاص برياضة " . $this->event->challengeSport->ar_sport_name,
                    'en'                    => 'suggest playground  ' . $this->playground->c_b_p_name .' for the challenge of ' . $this->challenge->challengeSport->en_sport_name,
                    'user_url'              => '/profile/' . sm_crypt($this->creator->id),
                    'user_img'              => !empty($this->creator->user_img) ? $this->creator->user_img : ''  ,
                    'user_name'             => $this->creator->name ,
                    'taraget_url'           => '/Challenge/Show/' . sm_crypt($this->event->id),
                ]);
                break;
        }
    }
}
