<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
   public function index(){
      // recuperer les donnees de la bdd depuis le model 
      // et les afficher dans la page index
      $products = Product::all();
     return view('Products.index',['products' => $products]);
   }
   public function create(){
    return view('Products.create');
   }
//    pour l envoie des donnees du formulaire
   public function store(Request $request){
    $data = $request-> validate([
      'name' => 'required',
      'qty' => 'required|numeric',
      'price' => 'required|decimal:0,2',
      'description' => 'nullable'
      
    ]);
   //  appeler le model pour envoyer les donnees vers la bdd MAIS POUR TRAITER LES ERRERS DE CREATION C DANS LA PAGE CREATE
   $newProduct = Product::create($data);
   return redirect(route('product.index'));
   }

   public function edit(Product $product){
   return view ('Products.edit',['product' => $product]);
   }
   public function update(Product $product, Request $request){
      $data = $request-> validate([
         'name' => 'required',
         'qty' => 'required|numeric',
         'price' => 'required|decimal:0,2',
         'description' => 'nullable'  ]);
         $product->update($data);
         return redirect (route('product.index'))->with('success','Product updated Succesffuly');
   }

   public function destroy(Product $product){
      $product->delete();
      return redirect (route('product.index'))->with('success','Product deleted Succesffuly');

   }
}
