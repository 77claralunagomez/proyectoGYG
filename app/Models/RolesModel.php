<?php
namespace App\Models; 
use CodeIgniter\Model;

/***Model es una extension de BaseModel para poder utilizar distintas funciones */
class RolesModel extends Model{

 protected $table = 'roles';  /**nombre de la tabla */
 protected $primaryKey = 'id_rol';

 protected $allowedFields = [
    'nombre',
    'descripcion',
    'activo'
     ];

 protected $useTimestamps = false; // Si no usas timestamps, déjalo en false

 protected $returnType = 'array'; // O 'object' si prefieres objetos

}
?>