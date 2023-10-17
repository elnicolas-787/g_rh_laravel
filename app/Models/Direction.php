<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class Direction extends Model
{
    use HasFactory;

    protected $fillable = [
    	'code_dir',
    	'nom_dir'
    ];

    public function services() {
        return $this->hasMany(Service::class)->cascadeOnDelete();
    }


}
