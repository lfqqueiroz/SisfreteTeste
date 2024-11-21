<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria';

    protected $fillable = [
        'nome',
    ];

    //Relacionando uma categoria que possui muitos produtos.
    public function produtos()
    {
        return $this->belongsToMany(
            Produto::class,
            'produtos_categorias',
            'id_categoria',
            'id_produto'
        );
    }
}