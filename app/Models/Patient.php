<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'full_name',
        'email',
        'contact_number',
        'dob',
        'doctor_id',
    ];

    // Auto-generate full_name when saving
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($patient) {
            $patient->full_name = trim("{$patient->first_name} {$patient->middle_name} {$patient->last_name}");
        });

        static::updating(function ($patient) {
            $patient->full_name = trim("{$patient->first_name} {$patient->middle_name} {$patient->last_name}");
        });
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
