<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Rental extends Model
{
    protected $table = 'rentals';
    protected $fillable = [
        'user_id',
        'code',
        'console_id',
        'television_id',
        'rent_day',
        'start_date',
        'end_date',
        'total_price',
    ];
    
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
    
    public function console()
    {
        return $this->belongsTo(Console::class);
    }

    public function television()
    {
        return $this->belongsTo(Television::class);
    }

    public function history()
    {
        return $this->hasOne(HistoryRental::class, 'rental_id');
    }

    /**
     * Boot method untuk menangkap event created.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($rental) {
            $userId = Auth::id(); // Gunakan Auth::id() untuk mendapatkan ID pengguna

            // Pastikan ID pengguna tersedia sebelum melanjutkan
            if ($userId) {
                HistoryRental::create([
                    'code' => $rental->code,
                    'user_id' => Auth::id(), // Mengambil ID pengguna yang sedang login
                    'rental_id' => $rental->id,
                    'console_id' => $rental->console_id,
                    'television_id' => $rental->television_id,
                    'start_date' => $rental->start_date,
                    'end_date' => $rental->end_date,
                    'total_price' => $rental->total_price,
                    'action' => 'created',
                    'description' => 'Rental created for rental_id: ' . $rental->id,
                    'timestamp' => now(),
                ]);

                    // Event ketika rental dibuat
            static::creating(function ($rental) {
                // Ubah status console menjadi not_available jika ada console_id
                if ($rental->console_id) {
                    Console::where('id', $rental->console_id)->update(['status' => 'not_available']);
                }

                // Ubah status television menjadi not_available jika ada television_id
                if ($rental->television_id) {
                    Television::where('id', $rental->television_id)->update(['status_television' => 'not_available']);
                }
            });

            static::creating(function ($rental) {
                do {
                    $code = 'ID-' . strtoupper(Str::random(8)); // Format: RNT-XXXXXXXX
                } while (self::where('code', $code)->exists());
    
                $rental->code = $code;
            });
            }
        });
    }
}



