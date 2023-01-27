<?php

namespace App\Notifications\Admin;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewUserRegisteredNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $admin, $user;
    public function __construct($admin, $user)
    {
        $this->admin = $admin;
        $this->user = $user;
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
    public function toMail($notifiable)
    {
        return (new MailMessage)

            ->subject('New ' . ucfirst($this->user->role) . '  Registered !')
            ->greeting('Hello, ' . $this->admin->name)
            ->line('A ' . ucfirst($this->user->role) . ' Registered Recently !')
            ->action('See ' . ucfirst($this->user->role), route('user.index'))
            ->line('Regards,')
            ->salutation(config('app.name'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $url = $this->user->role == 'company' ? route('company.show', [$this->user->company->id]) : route('candidate.show', [$this->user->candidate->id]);

        return [
            'title' => 'A ' . ucfirst($this->user->role) . ' registered recently',
            'url' => $url,
        ];
    }
}
