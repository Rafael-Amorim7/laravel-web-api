<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Episode extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['number'];
    protected $casts = ['watched' => 'boolean'];

    public function seasons()
    {
        return $this->belongsTo(Season::class);
    }

    //public function scopeWatched(Builder $query)
    //{
    //    $query->where('watched', true);
    //}

    protected function watched(): Attribute
    {
        return new Attribute(
            get: fn ($watched) => (bool) $watched,
            set: fn ($watched) => (bool) $watched,
        );
    }
}
