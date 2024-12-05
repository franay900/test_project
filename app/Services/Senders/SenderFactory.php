<?php

namespace App\Services\Senders;

use App\Models\Setting;

class SenderFactory
{
    public function create(string $method)
    {
        switch ($method){
            case 'email':
                return new EmailSender();

            case 'sms':
                return new SmsSender();
            case 'telegram':
                return new TelegramSender();

        }
    }
}
