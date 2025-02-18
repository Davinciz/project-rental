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
        'status',
    ];
    
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
    
    public function console()
    {
        return $this->belongsTo(Console::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function television()
    {
        return $this->belongsTo(Television::class);
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
                    $code = 'ID-' . strtoupper(Str::random(5)); // Format: RNT-XXXXXXXX
                } while (self::where('code', $code)->exists());
    
                $rental->code = $code;
            });
            }
        });
    }
}



