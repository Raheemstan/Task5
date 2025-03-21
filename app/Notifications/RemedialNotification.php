<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;

class RemedialNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
        $this->afterCommit();
    }

    public function via($notifiable)
    {
        return ['mail'];
    }
    
    public function toMail($notifiable)
    {
        Log::info('Sending remedial notification for ' . $notifiable->email);
        return (new MailMessage)
            ->subject('Remedial Class Required')
            ->greeting(greeting: 'Hello ' . $notifiable->name . ',')
            ->line('Our records indi    cate that you have failed more than 2 subjects in your recent exams.')
            ->line('As a result, you have been flagged for remedial classes.')
            ->action('View Details', url('/students/' . $notifiable->id))
            ->line('Please reach out to your academic advisor for further guidance.');
    }
}
