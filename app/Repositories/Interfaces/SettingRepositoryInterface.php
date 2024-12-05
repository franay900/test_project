<?php

namespace App\Repositories\Interfaces;

use App\Models\UserSetting;

interface SettingRepositoryInterface
{
    public function findOrCreate(int $userId, int $settingId);
    public function update(UserSetting $userSetting, string $value);
}
