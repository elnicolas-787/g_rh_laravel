<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'employees_id',
    	'date_debut',
    	'date_fin',
    	'heure_depart',
    	'heure_arrive',
    	'motif',
    	'decision',
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

}
