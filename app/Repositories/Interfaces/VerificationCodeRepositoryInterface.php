<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use App\Models\VerificationCode;

interface VerificationCodeRepositoryInterface
{
    public function create(array $data): VerificationCode;
    public function findByCode(string $code): VerificationCode;

}
