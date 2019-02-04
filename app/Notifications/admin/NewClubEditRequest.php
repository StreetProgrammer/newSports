<?php

namespace App\Notifications\admin;

use App\Model\User ;
use App\Model\PendingEdit;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewClubEditRequest extends Notification
{
    use Queueable;

    protected $club ;

    public $pendingEdit ;

    protected $link ;

    //protected $id ;

    public $linksArr = [
            '\App\Model\User' => '/clubs/',
            '\App\Model\User' => '/branches/',
            '\App\Model\User' => '/playgrounds/',

    ] ;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $club, PendingEdit $pendingEdit)
    {
        //$this->id = $id ;

        

        $this->club = $club ;

        $this->pendingEdit = $pendingEdit ;

        $this->link = $this->linksArr[$pendingEdit->taraget_model_type] ;

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
       return (new MailMessage)->view('admin.emails.NewClubEditRequest', 
                                    ['club'         => $this->club, 
                                     'pendingEdit'  => $this->pendingEdit,
                                     'link'         => $this->link . '' .  $this->pendingEdit->taraget_model_id,
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
