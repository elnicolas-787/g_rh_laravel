<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conge extends Model
{
    use HasFactory;

    protected $fillable = [
        'employees_id',
    	'date_debut',
    	'date_fin',
    	'motif',
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

}
