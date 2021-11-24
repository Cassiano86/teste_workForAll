<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categorias;
use App\Models\Estados;

class Clientes extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
                            'nome',
                            'tipo',
                            'contato',
                            'nascimento',
                            'categoria_fk',
                          ];

    public function Categorias(){
        return $this->belongsTo(Categorias::class, 'categoria_fk','id');
    }
    
    public function Estados(){
        return $this->belongsTo(Estados::class, 'estados_fk','id');
    }
}
