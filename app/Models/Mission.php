<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
    	'titre',
    	'description',
    	'lieu',
    	'employee_id',
    	'date_debut',
    	'date_fin',
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
