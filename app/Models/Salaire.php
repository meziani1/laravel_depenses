<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salaire extends Model
{
    protected $table = 'salaires';
    protected $primaryKey = 'id_salaire';
    public $incrementing = true;
    protected $fillable = ['montant', 'date_credit', 'user_id'];
    protected $dates = ['date_credit'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
