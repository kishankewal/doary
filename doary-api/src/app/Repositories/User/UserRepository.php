<?php

namespace App\Repositories\User;

use App\Models\User\UserModel;

class UserRepository {
    public function findByEmail(string $email): ?UserModel {
        return UserModel::where('email', $email)->first();
    }
    public function create(array $data): UserModel {
        return UserModel::create($data);
    }
}