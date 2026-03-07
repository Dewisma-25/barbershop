<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{

    //relasi dengan table transactions
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'id_kasir');
    }
}
