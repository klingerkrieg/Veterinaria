<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vacinacao extends Model {
    use HasFactory;

    protected $table = "vacinacoes";

    protected $fillable = ["data", "validade", "pet_id", "vacina_id","veterinario_id"];

    protected $casts = [
        'data' => 'date',
        'validade' => 'date',
    ];

    public function pet(): BelongsTo {
        return $this->belongsTo(Pet::class);
    }

    public function vacina(): BelongsTo {
        return $this->belongsTo(Vacina::class);
    }

    public function veterinario(): BelongsTo {
        return $this->belongsTo(User::class,"veterinario_id");
    }
}
