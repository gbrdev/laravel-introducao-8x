<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductCtr extends Controller
{
    private $products = ['SmarTV', 'Smartphone', 'Tablet'];

    public function index(){
        echo "<h1>Produtos</h1>";
        echo "<hr>";
        foreach($this->products as $p){
            echo "<p>{$p}</p>";
        }
    }

    public function addProduct($product){
        $this->products[] = $product;
        $this->index();
    }

    

}
