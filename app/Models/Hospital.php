<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
    ];

    public function user() {
        return $this->hasMany(User::class);
    }

    public function patient() {
        return $this->hasMany(Patient::class);
    }
}