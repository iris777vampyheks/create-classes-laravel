<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoClasse extends Model
{
    protected $fillable = ['name', 'classe_id']; 
    
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
}
