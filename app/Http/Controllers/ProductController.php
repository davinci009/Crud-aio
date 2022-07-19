<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index($product = null)
    {
        $products = Product::all();
        return view('products', compact(['products', 'product']));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'nullable|numeric',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'qty' => 'required'
        ]);

        if($request->filled('id')){
            $product = Product::find($request->id);
        }else{
            $product = new Product;
        }

        $product->fill($request->except('_token', 'id'));
        $product->save();

        return back()->with('status', $product->wasRecentlyCreated ? 'Creado exitosamente' : 'Actualizado Exitosamente');
    }

    public function edit(Product $product)
    {
        return $this->index($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        Session::flash('status', 'Eliminado correctamente');
        return redirect()->to(route('products.index'));
    }
}
