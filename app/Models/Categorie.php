<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
    	'code_cat',
    	'classe_cat',
    ];

    public function echelon() {
        return $this->hasMany(Echelon::class);
    }
}
