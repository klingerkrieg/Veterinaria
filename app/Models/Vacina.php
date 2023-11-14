<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vacina extends Model {
    use HasFactory;

    protected $fillable = ["nome", "validade_meses"];

    public function vacinacoes(): HasMany {
        return $this->hasMany(Vacinacao::class,"vacina_id");
    }

}
