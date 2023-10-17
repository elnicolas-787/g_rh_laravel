<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Echelon extends Model
{
    use HasFactory;

    protected $fillable = [
    	'code_echelon',
    ];

    public function categorie() {
        return $this->belongsTo(Categorie::class);
    }
}
