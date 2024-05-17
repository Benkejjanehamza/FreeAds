<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'description', 'photographie', 'location',  'critere', 'prix', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function images()
    {
        return $this->hasMany(AnnonceImage::class);
    }
}
