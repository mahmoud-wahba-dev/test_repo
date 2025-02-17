<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable=[
        'patient_id',
        'diagnosis_id',
        'date',
        'time',
        'price'
    ];

    protected $casts =[
        'date' => 'date',
//        'time' => 'time:H:i'
    ];

    /**
     * @return BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * @return BelongsTo
     */
    public function diagnosis()
    {
        return $this->belongsTo(Diagnosis::class);
    }
}
