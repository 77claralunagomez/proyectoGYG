<?php

namespace App\Models;

use CodeIgniter\Model;

/***Model es una extension de BaseModel para poder utilizar distintas funciones */
class DetalleFacturaModel extends Model
{

    protected $table = 'detallefactura';
    /**nombre de la tabla */
    protected $primaryKey = 'id_detalle_factura';

    protected $allowedFields = [
        'id_producto',
        'id_pedido',
        'cantidad',
        'precio_unitario'
    ];

    protected $useTimestamps = false; // Si no usas timestamps, déjalo en false

    protected $returnType = 'array'; // O 'object' si prefieres objetos

}
?>