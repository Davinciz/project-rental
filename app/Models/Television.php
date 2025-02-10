<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Television extends Model
{
    protected $table = 'televisions';
    protected $fillable = ['model', 'price_television', 'status_television'];

    public function rentals()
    {
        return $this->belongsTo(Television::class);
    }
    public function getModelWithStatusAttribute()
    {
        return $this->status_television === 'avalaible' 
            ? $this->model 
            : $this->model . ' (Not Available)';
    }

}
