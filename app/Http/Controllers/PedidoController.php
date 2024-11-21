<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\PedidoProduto;
use Illuminate\Support\Facades\Log;

class PedidoController extends Controller
{
    public function store(Request $request)
    {
        try {
            Log::info('Dados recebidos:', $request->all());
    
            // Faz a validação das informações
            $validatedData = $request->validate([
                'id_cliente' => 'required|exists:clientes,id_cliente',
                'produtos' => 'required|array|min:1',
                'produtos.*.id_produto' => 'required|exists:produtos,id_produto',
                'produtos.*.quantidade' => 'required|integer|min:1',
                'status' => 'nullable|string',
            ]);
    
            Log::info('Dados validados com sucesso.');
    
            // Faz a ciração de um novo pedido
            $pedido = Pedido::create([
                'id_cliente' => $validatedData['id_cliente'],
                'status' => $validatedData['status'] ?? 'pendente',
            ]);
    
            if (!$pedido->id) {
                Log::error('Falha ao criar pedido, ID não gerado');
                return response()->json([
                    'message' => 'Falha ao criar pedido',
                ], 500);
            }
    
            // Relaciona os produtos informados ao pedido criado
            foreach ($validatedData['produtos'] as $produto) {
    
                PedidoProduto::create([
                    'id_pedido' => $pedido->id,
                    'id_produto' => $produto['id_produto'],
                    'quantidade' => $produto['quantidade'],
                ]);
            }
    
            Log::info('Produtos associados ao pedido.', ['pedido_id' => $pedido->id]);
    
            return response()->json([
                'message' => 'Pedido criado com sucesso!',
                'pedido' => $pedido,
            ], 201);
    
        } catch (\Exception $e) {
            Log::error('Erro ao criar pedido.', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'Erro ao criar pedido.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
{
    
    // Verifica se o pedido existe na tabela de pedidos
    $pedido = Pedido::find($id);

    if (!$pedido) {
        return response()->json(['message' => 'Pedido não encontrado.'], 404);
    }

    // Faz a validação das informações
    $validated = $request->validate([
        'id_cliente' => 'required|exists:clientes,id_cliente',
        'produtos' => 'required|array|min:1',
        'produtos.*.id_produto' => 'required|exists:produtos,id_produto',
        'produtos.*.quantidade' => 'required|integer|min:1',
        'status' => 'required|in:pendente,em andamento,finalizado'
    ]);

    try {
        // Faz a atualização dos dados do pedido
        $pedido->update([
            'id_cliente' => $validated['id_cliente'],
            'status' => $validated['status']
        ]);

            // Remove os produtos associados ao pedido anterior
            $pedido->produtos()->detach();
    
            // Associa os novos produtos ao pedido
            foreach ($validated['produtos'] as $produto) {
                $pedido->produtos()->attach($produto['id_produto'], [
                    'quantidade' => $produto['quantidade']
                ]);
            }
    
            // Retorna o pedido atualizado com os produtos
            return response()->json([
                'message' => 'Pedido atualizado com sucesso.',
                'pedido' => $pedido->load('produtos')
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao atualizar o pedido.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
            
}
