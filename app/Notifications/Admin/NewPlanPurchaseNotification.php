<?php

namespace App\Notifications\Admin;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewPlanPurchaseNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $admin, $order, $plan, $user;
    public function __construct($admin, $order, $plan, $user)
    {
        $this->admin = $admin;
        $this->order = $order;
        $this->plan = $plan;
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
        return (new MailMessage)

            ->subject(ucfirst($this->user->name) . ' Has Purchased The ' . ucfirst($this->plan->label) . ' Plan!')
            ->greeting('Hello, ' . $this->admin->name)
            ->line(ucfirst($this->user->name) . ' Has Purchased The ' . ucfirst($this->plan->label) . ' Plan!')
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
        return [
            'title' => ucfirst($this->user->name) . ' has purchased the ' . ucfirst($this->plan->label) . ' plan!',
            'url' => route('order.show', $this->order->id)
        ];
    }
}
