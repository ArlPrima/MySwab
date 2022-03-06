<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phoneNumber',
        'headOfFamily',
        'numberOfTest',
        'testDate',
        'address',
        'hospital_id',
    ];

    public function hospital() {
        return $this->belongsTo(Hospital::class);
    }

    public function result() {
        return $this->hasOne(Result::class);
    }

    public function payment() {
        return $this->hasOne(Payment::class);
    }
}