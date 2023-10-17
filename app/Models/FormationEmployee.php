<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormationEmployee extends Model
{
    use HasFactory;

    protected $fillable = [
    	'formation_id',
    	'employee_id',
    ];

    public function formation() {
        return $this->belongsTo(Formation::class);
    }
    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
