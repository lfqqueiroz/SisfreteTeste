<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';
    protected $primaryKey = 'id_produto'; 

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'estoque',
    ];

    //Relacionando um produto que possui muitas categorias.
    public function categorias()
    {
        return $this->belongsToMany(
            Categoria::class,
            'produtos_categorias',
            'id_produto',
            'id_categoria'
        );
    }

    //Relacionando um produto que possui muitos pedidos.
    public function pedidos()
    {
        return $this->belongsToMany(
            Pedido::class,
            'pedido_produtos',
            'id_produto',
            'id_pedido'
        )->withPivot('quantidade');
    }
}
