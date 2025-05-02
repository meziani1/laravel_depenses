<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    protected $table = 'depenses';
    protected $primaryKey = 'id_depense';
    public $incrementing = true;
    protected $fillable = ['libelle', 'date', 'montant', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
} 