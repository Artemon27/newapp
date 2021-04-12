<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $guarded = [];  
    
    public function available()
    {
        $product = product::Where('status','=','available')->get();
        if ($product == NULL)
        {
            return false;
        }
        for ($i=0; $i<$product->count();$i++)
        { 
            $product[$i]->data=json_decode($product[$i]->data);
        }        
        return $product;
    }
    
    public function createNew($product) {
        unset($product['_token']);
        product::create($product);
        return;
    }
    
    public function edit($product) {
        unset($product['_token']);
        $pr=product::where('art','=',$product['art'])->get();
        if ($pr != NULL)
        {
            for ($i=0;$i<$pr->count();$i++)
            {
                if ($pr[$i]->id != $product['id'])
                {                  
                
                    return 0;
                }
            }
        }      
        product::find($product['id'])->update($product);
        
        return 1;
    }
    
    public function del($id)
    {     
        Product::destroy($id);
    }
}
