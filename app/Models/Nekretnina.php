<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nekretnina extends Model
{
    use HasFactory;

    protected $table = 'nekretninas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'oznaka',
        'povrsina_m2',
        'cena',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'povrsina_m2' => 'decimal:2',
            'cena' => 'decimal:2',
        ];
    }
}
