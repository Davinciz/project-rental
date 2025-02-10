<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryRental extends Model
{
    use HasFactory;

    protected $table = 'history_rental'; // Nama tabel
    protected $fillable = [
        'code',
        'user_id',
        'rental_id',
        'console_id',
        'television_id',
        'start_date',
        'end_date',
        'total_price',
    ];

    public function history()
    {
        return $this->hasOne(HistoryRental::class);
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Console
    public function console()
    {
        return $this->belongsTo(Console::class);
    }

    // Relasi ke Television
    public function television()
    {
        return $this->belongsTo(Television::class);
    }
}
