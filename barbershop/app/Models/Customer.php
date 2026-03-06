<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'no_hp',
        'alamat'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}