<?php

namespace App\Models;

use CodeIgniter\Model;

/***Model es una extension de BaseModel para poder utilizar distintas funciones */
class DetalleFacturaModel extends Model
{

    protected $table = 'factura';
    /**nombre de la tabla */
    protected $primaryKey = 'id_factura';

    protected $allowedFields = [
        'id_usuario',
        'fecha_factura',
        'total',
        'subtotal'
    ];

    protected $useTimestamps = false; // Si no usas timestamps, déjalo en false

    protected $returnType = 'array'; // O 'object' si prefieres objetos

}
?>