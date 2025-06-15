<?php

namespace App\Controllers;
 
use App\Models\PedidoModel;
use App\Models\ProductosModel;
use App\Models\CarritoModel;

class CarritoController extends BaseController
{
   
   public function __construct()
   {
    helper(['form', 'url', 'cart']);
    $cart = \Config\Services::cart();
    $session = session();
   }

}