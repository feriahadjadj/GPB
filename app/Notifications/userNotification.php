<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class userNotification extends Notification
{
    use Queueable;
    public $user ;
    public $projet;
    public $type;
    public $text;



    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$projet,$type,$text)
    {
        $this->user=$user;
        $this->projet=$projet;
        $this->type=$type;
        $this->text=$text;
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [

            'user_id'=> $this->user->id,
            'user_name'=> $this->user->name,
            'projet_id'=>$this->projet->id,
            'projet_name'=>$this->projet->designation,
            'type'=>$this->type,
            'text'=> $this->text,


            //
        ];
    }
}
