<?php

namespace App\Models; 
use CodeIgniter\Model;

/***Model es una extension de BaseModel para poder utilizar distintas funciones */
class UsuariosModel extends Model{

 protected $table = 'usuarios';  /**nombre de la tabla */
 protected $primaryKey = 'id_usuarios';

 protected $allowedFields = [
    'nombre',
    'apellido',
    'email',
    'pass',
    'rol',
    'activo'
     ];

 protected $useTimestamps = false; // Si no usas timestamps, déjalo en false

 protected $returnType = 'array'; // O 'object' si prefieres objetos

 public function validarUsuario($email, $pass){
    $email = $this->where(['email' => $email, 'activo' => 1])->first();
    if($email && password_verify($pass, $email['pass'])){
        return $email;
    }

    return null;
    
    }   
}
?>