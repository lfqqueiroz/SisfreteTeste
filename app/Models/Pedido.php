<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';
    protected $primaryKey = 'id_pedido';

    protected $fillable = [
        'id_cliente',
        'status',
    ];

    //Relacionando um pedido que pertence a um cliente.
     
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    //Relacionando um pedido que possui muitos produtos.
    
    public function produtos()
    {
        return $this->belongsToMany(
            Produto::class,
            'pedido_produtos',
            'id_pedido',
            'id_produto'
        )->withPivot('quantidade');
    }

    // Relacionando um pedido que possui um pagamento.
    
    public function pagamento()
    {
        return $this->hasOne(Pagamento::class, 'id_pedido', 'id_pedido');
    }
}
