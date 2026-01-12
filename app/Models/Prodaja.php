<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prodaja extends Model
{
    use HasFactory;

    protected $table = 'prodajas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kupac_id',
        'agent_id',
        'nekretnina_id',
        'datum_kreiranja',
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
            'kupac_id' => 'integer',
            'agent_id' => 'integer',
            'nekretnina_id' => 'integer',
            'datum_kreiranja' => 'date',
        ];
    }

    public function kupac(): BelongsTo
    {
        return $this->belongsTo(Kupac::class);
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }

    public function nekretnina(): BelongsTo
    {
        return $this->belongsTo(Nekretnina::class);
    }
}
