<?php

namespace App\Models;

use CodeIgniter\Model;

/***Model es una extension de BaseModel para poder utilizar distintas funciones */
class PedidoModel extends Model
{

    protected $table = 'pedido';
    /**nombre de la tabla */
    protected $primaryKey = 'id_pedido';

    protected $allowedFields = [
        'id_usuario',
        'fecha_pedido',
        'total',
        'estado_pedido',
        'direccion_envio',
        'metodo_pago'
    ];

    protected $useTimestamps = false; // Si no usas timestamps, déjalo en false

    protected $returnType = 'array'; // O 'object' si prefieres objetos

}
?>