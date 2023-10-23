<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
  use Queueable;

  public $url;

  /**
   * Create a new notification instance.
   */
  public function __construct(string $url)
  {
    $this->url = $url;
  }

  /**
   * Get the notification's delivery channels.
   *
   * @return array<int, string>
   */
  public function via(object $notifiable): array
  {
    return ['mail'];
  }

  /**
   * Get the mail representation of the notification.
   */
  public function toMail(object $notifiable): MailMessage
  {
    return (new MailMessage)
      ->line('Você está recebendo este e-mail porque recebemos uma solicitação de redefinição de senha para sua conta.')
      ->action('Modificar Senha', url($this->url))
      ->line('Se você não solicitou a redefinição de senha, nenhuma ação adicional será necessária.')
      ->line('Obrigado por usar nosso aplicativo!');
  }

  /**
   * Get the array representation of the notification.
   *
   * @return array<string, mixed>
   */
  public function toArray(object $notifiable): array
  {
    return [
      //
    ];
  }
}
