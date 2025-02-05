<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelReason extends Model
{
    use HasFactory;

    protected $fillable = ['reason'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'cancel_reason_id');
    }
}
