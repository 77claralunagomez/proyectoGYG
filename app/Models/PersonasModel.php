<?php

namespace App\Models;

use CodeIgniter\Model;

/***Model es una extension de BaseModel para poder utilizar distintas funciones */
class PersonasModel extends Model
{

    protected $table = 'personas';
    /**nombre de la tabla */
    protected $primaryKey = 'id_persona';

    protected $allowedFields = [
        'dni',
        'nombre',
        'apellido',
        'id_domicilio',
        'telefono'
    ];

    protected $useTimestamps = false; // Si no usas timestamps, déjalo en false

    protected $returnType = 'array'; // O 'object' si prefieres objetos

}
