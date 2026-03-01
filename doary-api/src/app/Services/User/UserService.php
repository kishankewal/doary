<?php

namespace App\Services\User;

use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService {
    protected $userRepository;
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function register(array $data, string $ip) {
        if ($this->userRepository->findByEmail($data['email'])) {
            throw ValidationException::withMessages([
                'email' => ['Email already exists.']
            ]);
        }
        $userData = [
            'name' => $data['name'],
            'email' => strtolower($data['email']),
            'password' => Hash::make($data['password']),
            'phoneCountryCode' => $data['phoneCountryCode'] ?? null,
            'phoneNumber' => $data['phoneNumber'] ?? null,
            'status' => 1,
            'role' => 'user',
            'createdOn' => time(),
            'creationIp' => $ip,
        ];
        return $this->userRepository->create($userData);
    }

    public function checkEmailExists(string $email): bool {
        return $this->userRepository->findByEmail($email) !== null;
    }
}