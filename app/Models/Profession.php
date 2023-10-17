<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;

    protected $fillable = [
    	'code_prof',
    	'nom_prof'
    ];

    public function employee() {
        return $this->hasMany(Employee::class);
    }
}
