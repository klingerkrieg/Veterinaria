<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = ["nome","nascimento","foto","especie_id","dono_id"];


    const GATO      = 1;
    const CACHORRO  = 2;
    const PAPAGAIO  = 3;

    public static $especies = [Pet::GATO=>"Gato", Pet::CACHORRO=>"Cachorro", Pet::PAPAGAIO=>"Papagaio"];

    public function dono(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function vacinacoes(): HasMany {
        return $this->hasMany(Vacinacao::class,"pet_id");
    }
}
