<?php

namespace App\Services\Settings;

use App\Jobs\DeleteCodeJob;
use App\Repositories\SettingsRepository;
use App\Repositories\VerificationCodeRepository;
use Carbon\Carbon;

class UserSettingService
{
    private $settingRepository;
    private $verificationCodeRepository;

    public function __construct(SettingsRepository $settingRepository, VerificationCodeRepository $verificationCodeRepository)
    {
        $this->settingRepository = $settingRepository;
        $this->verificationCodeRepository = $verificationCodeRepository;
    }

    public function toggleSetting(int $userId, int $settingId, string $code)
    {
        $verificationCode = $this->verificationCodeRepository->findByCode($code);


        if (is_null($verificationCode) ||
            Carbon::parse($verificationCode->expires_at)->isPast() ||
            $verificationCode->user_id !== $userId) {
            return response()->json(['error' => 'Unable to update setting'], 500);
        }

        dispatch(new DeleteCodeJob($verificationCode->id));

        $userSetting = $this->settingRepository->findOrCreate($userId, $settingId);

        $newValue = $userSetting->value === 'true' ? 'false' : 'true';

        $setting = $this->settingRepository->update($userSetting, $newValue);

        return response()->json(['ok'], 200);
    }
}
