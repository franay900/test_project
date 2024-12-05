<?php

namespace App\Services\Settings;

use App\Jobs\DeleteCodeJob;
use App\Models\Setting;
use App\Models\User;
use App\Repositories\VerificationCodeRepository;
use App\Services\Senders\SenderFactory;
use Carbon\Carbon;
use Illuminate\Support\Str;

class VerificationCodeService
{
    protected $verificationCodeRepository;
    protected $messageSenderFactory;

    public function __construct(VerificationCodeRepository $verificationCodeRepository, SenderFactory $messageSenderFactory)
    {
        $this->verificationCodeRepository = $verificationCodeRepository;
        $this->messageSenderFactory = $messageSenderFactory;
    }

    public function requestVerificationCode(User $user, int $setting_id, string $method): string
    {
        $code = Str::random(6);
        $expiresAt = Carbon::now()->addMinutes(10);

        $verificationCode = $this->verificationCodeRepository->create([
            'user_id' => $user->id,
            'setting_id' => $setting_id,
            'code' => $code,
            'method' => $method,
            'expires_at' => $expiresAt,
        ]);

        $sender = $this->messageSenderFactory->create($method);
        $contact = $this->getUserContact($user, $method);

        dispatch(new DeleteCodeJob($verificationCode->id))->delay(now()->addMinutes(3));
        return $sender->send($contact, $code);
    }

    protected function getUserContact(User $user, string $method)
    {
        switch ($method) {
            case 'sms':
                return $user->phone;
            case 'email':
                return $user->email;
            case 'telegram':
                return $user->telegram_id;
        }
    }
}
