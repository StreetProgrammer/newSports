<?php

namespace App\Notifications\admin;

use App\Model\User ;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewClubRegistered extends Notification /*implements ShouldQueue*/
{
    use Queueable;

    public $club ;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $club)
    {
        $this->club = $club ;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
        //return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->view('admin.emails.NewClubRegister', ['club' => $this->club]) ;
                    
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
            'ar'        => 'تم التسجيل من قبل نادي جديد',
            'en'        => 'New Club Registered',
            'url'       => '/clubs/' . $this->club->id,
            'clubId'    => $this->club->id,
            'clubName'  => $this->club->name,
            'iconClass' =>'fa fa-user-plus text-aqua'
        ];
    }
}
