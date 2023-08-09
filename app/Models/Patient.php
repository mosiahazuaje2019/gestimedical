<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'personal_id',
        'age',
        'city_id'
    ];

    public function patient_lms() {
       return $this->hasMany(PatientLm::class, 'patient_id', 'id');
    }

    public function patient_adress() {
        return $this->hasMany(PatientAdress::class)->where('category','address');
    }

    public function patient_phone() {
        return $this->hasMany(PatientAdress::class)->where('category','phone');
    }
}
