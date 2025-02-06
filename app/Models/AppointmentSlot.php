<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentSlot extends Model
{
    use HasFactory;

    protected $fillable = ['doctor_id', 'date', 'start_time', 'end_time', 'available'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public static function generateSlotsForDate($doctor_id, $date)
    {
        $schedule = Schedule::where('doctor_id', $doctor_id)
                            ->where('day_of_week', date('l', strtotime($date)))
                            ->first();

        if ($schedule) {
            $startTime = new \DateTime($schedule->start_time);
            $endTime = new \DateTime($schedule->end_time);

            while ($startTime < $endTime) {
                $slotEnd = clone $startTime;
                $slotEnd->modify('+30 minutes');  // Intervalo de 30 minutos

                self::updateOrCreate([
                    'doctor_id' => $doctor_id,
                    'date' => $date,
                    'start_time' => $startTime->format('H:i:s'),
                    'end_time' => $slotEnd->format('H:i:s'),
                ], [
                    'available' => true
                ]);

                $startTime = $slotEnd;
            }
        }
    }
}
