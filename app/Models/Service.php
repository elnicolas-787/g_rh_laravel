<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Direction;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
    	'code_serv',
    	'nom_serv',
    	'direction_id',
    ];

    public function direction() {
        return $this->belongsTo(Direction::class);
    }

    public function employee() {
        return $this->hasMany(Employee::class);
    }
}
