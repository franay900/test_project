<?php

namespace App\Repositories;

use App\Models\VerificationCode;
use App\Repositories\Interfaces\VerificationCodeRepositoryInterface;

class VerificationCodeRepository implements VerificationCodeRepositoryInterface
{
    public function create(array $data): VerificationCode
    {
        return VerificationCode::create($data);
    }

    public function findByCode(string $code): VerificationCode
    {
        return VerificationCode::where('code', $code)->first();
    }


}
