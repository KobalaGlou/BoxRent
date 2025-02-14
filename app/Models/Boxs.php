<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boxs extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'boxes';
    protected $fillable = ['name', 'desc', 'lieux', 'prix', 'occupé', 'user_id'];
    public $timestamps = false; // Désactive les timestamps

    public function contrats()
    {
        return $this->hasMany(Contrat::class);
    }
}
