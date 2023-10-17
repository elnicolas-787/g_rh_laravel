<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
    	'immatriculation',
    	'photo',
    	'nom',
    	'prenom',
    	'adresse',
    	'email',
    	'date_naissance',
    	'lieu_naissance',
    	'cin',
    	'sexe',
    	'situation_f',
    	'telephone',
        'services_id',
        'professions_id',
    ];

    public function profession() {
        return $this->belongsTo(Profession::class);
    }

    public function services() {
        return $this->belongsTo(Service::class);
    }

    public function absence() {
        return $this->hasMany(Absence::class);
    }

    public function conge() {
        return $this->hasMany(Conge::class);
    }

    public function user() {
        return $this->hasMany(Absence::class);
    }

    public function mission() {
        return $this->hasMany(Mission::class);
    }

    public function formation_employee() {
        return $this->hasMany(FormationEmployee::class)->cascadeOnDelete();
    }
}
