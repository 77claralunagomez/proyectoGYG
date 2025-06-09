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
    protected $primaryKey = 'id_productos';
    protected $returnType = 'array'; // O 'object' si prefieres objetos

    protected $allowedFields = [
        'id_categoria',
        'nombre',
        'descripcion',
        'precio',
        'cantidad',
        'url_imagen',
        'activo'
    ];
     
    protected $useSoftDeletes= false;
    protected $useTimestamps = false; // Si no usas timestamps, déjalo en false

}
