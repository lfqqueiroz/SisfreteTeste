<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
        public function index(Request $request)
    {
        $query = Produto::query();

        if ($request->filled('categoria')) {
            $query->whereHas('categorias', function ($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->categoria . '%');
            });
        }

        if ($request->filled('preco_min') && $request->filled('preco_max')) {
            $query->whereBetween('preco', [$request->preco_min, $request->preco_max]);
        }

        return response()->json($query->get());
    }
}
