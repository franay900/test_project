<?php

namespace App\Services\Senders;

interface SenderInterface
{
    public function send(string $to, string $text): bool;
}
