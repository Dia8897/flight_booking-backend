<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Passenger extends Model
{
    use HasFactory, SoftDeletes;

    protected $hidden = ['password'];

    protected $garded = [
        'first_name',
        'last_name',
        'email',
        'password',
        'dob',
        'passport_expiry_date'
    ];

    public function flights()
    {
        return $this->belongsToMany(Flight::class);
    }
}
