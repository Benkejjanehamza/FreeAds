<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnonceImage extends Model
{
    protected $fillable = ['filename', 'annonce_id'];

    use HasFactory;
    public function annonce()
    {
        return $this->belongsTo(Annonce::class);
    }
}
