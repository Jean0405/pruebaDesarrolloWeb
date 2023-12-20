<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical_history extends Model
{
    use HasFactory;
    protected $fillable = [
        'professional_id',
        'patient_id',
        'date_time',
        'history_consecutive',
        'current_patient_state',
        'medical_history',
        'final_evolution',
        'professional_opinion',
        'recommendations',
        'is_accepted',
    ];
}
