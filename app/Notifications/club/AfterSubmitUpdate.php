<?php

namespace App\Notifications\club;

use App\Model\User ;
use App\Model\PendingEdit;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AfterSubmitUpdate extends Notification
{
    use Queueable ;

    protected $club ;

    public $name ;

    protected $case ;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $club, $case)
    {   
        $this->club = $club ;
        $this->name = $club->name ;
        $this->case = $case ;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //return ['mail', 'database'];
        //return ['database'];
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
       return (new MailMessage)->view('club.emails.pages.AfterSubmitUpdate', 
                                    ['club'         => $this->club, 
                                     'case'         => $this->case,
                                    ]) ;
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
            'ar'        => 'طلب تعديل بيانات',
            'en'        => 'Club Request Edit Data',
            'url'       => $this->link . '' .  $this->pendingEdit->taraget_model_id,
            'clubId'    => $this->club->id,
            'clubName'  => $this->club->name,
            'iconClass'  => 'fa fa-edit text-yellow'
        ];
    }
}
