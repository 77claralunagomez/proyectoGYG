<?php

namespace App\Models;

use CodeIgniter\Model;

/***Model es una extension de BaseModel para poder utilizar distintas funciones */
class CarritoModel extends Model
{

    protected $table = 'carrito';
    /**nombre de la tabla */
    protected $primaryKey = 'id_carrito';

    protected $allowedFields = [
        'id_usuario',
        'id_producto',
        'cantidad'
    ];

    protected $useTimestamps = false; // Si no usas timestamps, déjalo en false

    protected $returnType = 'array'; // O 'object' si prefieres objetos

}
?>