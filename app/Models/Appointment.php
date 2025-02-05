<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 'doctor_id', 'specialty_id', 'schedule_date',
        'start_time', 'end_time', 'status_id', 'notes', 'cancel_reason_id'
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function status()
    {
        return $this->belongsTo(AppointmentStatus::class);
    }

    public function cancelReason()
    {
        return $this->belongsTo(CancelReason::class);
    }

    public function logs()
    {
        return $this->hasMany(AppointmentLog::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
