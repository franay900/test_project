<?php

namespace App\Services\Senders;

class TelegramSender implements SenderInterface
{

    public function send(string $to, string $text): bool
    {
        return true;
    }
}
