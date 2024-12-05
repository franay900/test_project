<?php

namespace App\Services\Senders;

class EmailSender implements SenderInterface
{

    public function send(string $to, string $text): bool
    {
        return true;
    }
}
