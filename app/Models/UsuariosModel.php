<?php

namespace App\Models; 
use CodeIgniter\Model;

/***Model es una extension de BaseModel para poder utilizar distintas funciones */
class UsuariosModel extends Model{

 protected $table = 'usuarios';  /**nombre de la tabla */
 protected $primaryKey = 'id_usuarios';

 protected $allowedFields = [
    'id_personas',
    'id_rol',
    'email',
    'pass',
    'activo'
     ];

 protected $useTimestamps = false; // Si no usas timestamps, déjalo en false

 protected $returnType = 'array'; // O 'object' si prefieres objetos

}
?>