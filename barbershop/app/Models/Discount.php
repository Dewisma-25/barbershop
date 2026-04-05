<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Discount extends Model
{
    protected $fillable = [
        'nama',
        'persen',
        'tanggal_mulai',
        'tanggal_selesai',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
    ];

    // Relasi ke user yang membuat diskon
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Ambil diskon yang aktif di tanggal tertentu
    public static function getActiveDiscount($tanggal)
    {
        return self::where('is_active', 1)
            ->where('tanggal_mulai', '<=', $tanggal)
            ->where('tanggal_selesai', '>=', $tanggal)
            ->first();
    }
}