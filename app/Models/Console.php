<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Console extends Model
{
    protected $table = 'consoles';
    protected $fillable = ['name', 'description', 'price_console', 'status', 'image'];

    public function rentals()
    {
        return $this->belongsTo(Console::class);
    }

    public function getNameWithStatusAttribute()
    {
        return $this->status === 'avalaible' 
            ? $this->name 
            : $this->name . ' (Not Available)';
    }

}

