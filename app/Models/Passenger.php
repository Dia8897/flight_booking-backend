<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Passenger extends Model
{
    use HasFactory, SoftDeletes;

    protected $hidden = ['password'];

    protected $fillable = [
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

    //default values
    protected static function booted()
    {
        static::creating(function ($passenger) {
            if (!isset($passenger->dob)) {
                $passenger->dob = '2000-01-01';
            }
            if (!isset($passenger->passport_expiry_date)) {
                $passenger->passport_expiry_date = '2030-01-01';
            }
        });
    }
}
