
<?php
namespace App\Models; 
use CodeIgniter\Model;

/***Model es una extension de BaseModel para poder utilizar distintas funciones */
class DomiciliosModel extends Model{

 protected $table = 'domicilios';  /**nombre de la tabla */
 protected $primaryKey = 'id_domicilio';

 protected $allowedFields = [
    'calle',
    'numero',
    'codigo_postal',
    'localidad',
    'provincia',
    'pais',
    'activo'
     ];

 protected $useTimestamps = false; // Si no usas timestamps, déjalo en false

 protected $returnType = 'array'; // O 'object' si prefieres objetos

}
?>