<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locataire extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nom',
        'tel',
        'email',
        'adresse',
        'compte_bancaire',
    ];
    public $timestamps = false; // Désactive les timestamps

    /**
     * Relation to the User model (Propriétaire).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation to the Box model.
     */
    public function box()
    {
        return $this->hasOne(Boxs::class, 'locataire_id');
    }
}
