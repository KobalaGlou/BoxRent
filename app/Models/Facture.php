<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false; // Désactive les timestamps automatiques

    protected $fillable = ['id', 'contrat_id', 'montant', 'date_creation', 'periode', 'date_paiement'];

    public function contrat()
    {
        return $this->belongsTo(Contrat::class);
    }

    public function estPayee()
    {
        return !is_null($this->date_paiement);
    }
}
