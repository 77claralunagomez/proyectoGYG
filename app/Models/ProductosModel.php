<?php

namespace App\Models;

use CodeIgniter\Model;

/***Model es una extension de BaseModel para poder utilizar distintas funciones
 * sacado de modeling Data, Using CodeIgneiter Model
 */
class ProductosModel extends Model
{

    protected $table = 'productos';
    /**nombre de la tabla */
    protected $primaryKey = 'id_producto';
    protected $returnType = 'array'; // O 'object' si prefieres objetos

    protected $allowedFields = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'url_imagen',
        'activo',
        'categoria'
    ];
     
    protected $useSoftDeletes= false;
    protected $useTimestamps = false; // Si no usas timestamps, déjalo en false

}
?>