<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model {
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'phoneCountryCode',
        'phoneNumber',
        'status',
        'role',
        'createdOn',
        'creationIp',
        'updatedOn',
        'updationIp'
    ];
    
    public $timestamps = false; // since you are not using created_at
}
