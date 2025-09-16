<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'poli_id', 'doctor_id', 'schedule', 'status'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
 
    public function queue()
    {
        return $this->hasOne(Queue::class);
    }
}
