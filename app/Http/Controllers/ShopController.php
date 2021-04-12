<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductEditRequest;
use App\Notifications\email;

class ShopController extends Controller
{
    
    public function mainPage() {
        $products= product::get()->sortby('id');
        return view('shop', compact('products'));
    }
    
    public function createProduct(ProductRequest $request) {
         
        $product=new product; 
        $product->createNew($request->all());
        $email = new email;
        $email -> tomail($request);
        return redirect('/')->with('message', 'Продукт успешно добавлен');
    }
    
    public function editProduct(ProductEditRequest $request) {
        $product=new product; 
        $retcode = $product->edit($request->all());
        if ($retcode)
        {
            return redirect('/')->with('message', 'Продукт успешно отредактирован');
        }
        else
        {
            return redirect('/')->withErrors("Ошибка! Такой артикул уже существует!");
        }
        
    }
    
    public function delProduct(Request $request) {
         
        $product=new product;  
        $product->del($request->id);
        return redirect('/')->with('message', 'Продукт успешно удалён');
    }
}
