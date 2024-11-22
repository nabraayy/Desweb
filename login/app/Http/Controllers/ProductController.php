<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Product {
    public $name, $id;
 
    function __construct($name, $id) {
        $this->name = $name;
        $this->id = $id;
    }
 }

class ProductController  extends Controller{
    public $seleccion, $ofertas, $topventas;

    function init_variables() {

        // JSON String 
        $this->seleccion = json_decode('[
           { "name" : "producto seleccion 1", "id" : 991},
           { "name" : "producto seleccion 2", "id" : 992}
        ]');

        // Array asociativo
        $this->ofertas = [
            [ "name" => "producto oferta 1", "id" => 993],
            [ "name" => "producto oferta 2", "id" => 994],
            [ "name" => "producto oferta 3", "id" => 99898]
        ];

        // Array de objetos
        $this->topventas = [
            new Product("producto top 1", 995),
            new Product("producto top 2", 996)
        ];
    }



    function index(){
        return view('product.index');
    }

    function ofertas(){
        $this->init_variables();


        return view('product.ofertas')->with('nayara', $this->ofertas );
    }
    function top_ventas(){
        return view('product.topventas');
    }


}
