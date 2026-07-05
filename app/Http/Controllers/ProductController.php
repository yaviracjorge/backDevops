<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
// GET: Devuelve todos los productos
    public function index()
    {
        return Product::all();
    }

    // POST: Crea un nuevo producto
    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return response()->json($product, 201); // 201 significa "Creado"
    }

    // GET (con ID): Devuelve un producto específico
    public function show(Product $product)
    {
        return $product;
    }

    // PUT/PATCH: Actualiza un producto
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return response()->json($product, 200);
    }

    // DELETE: Elimina un producto
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 200);
    }
}
