<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_debut',
        'date_fin',
        'prix_mois',
        'user_id',
        'locataire_id',
        'box_id',
        'template_id'
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];


    // Relation avec l'utilisateur (propriétaire)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec le locataire
    public function locataire()
    {
        return $this->belongsTo(Locataire::class);
    }

    // Relation avec la box
    public function box()
    {
        return $this->belongsTo(Boxs::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }
}
