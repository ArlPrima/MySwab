<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_id',
        'approvedBy',
        'status',
        'detail',
    ];

    public function patient() {
        return $this->belongsTo(Patient::class);
    }

    public function approved() {
        return $this->belongsTo(User::class, 'approvedBy', 'id');
    }
}
