<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = [
    	'theme_formation',
        'date_debut',
    	'date_fin',
    	'specialite',
    	'lieu_formation',
    ];

    public function formation_employee() {
        return $this->hasMany(FormationEmployee::class)->cascadeOnDelete();
    }
}
