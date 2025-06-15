<?php

namespace App\Models; 
use CodeIgniter\Model;

/***Model es una extension de BaseModel para poder utilizar distintas funciones */
class UsuariosModel extends Model{

 protected $table = 'usuarios';  /**nombre de la tabla */
 protected $primaryKey = 'id_usuario';

 protected $allowedFields = [
    'nombre',
    'apellido',
    'domicilio',
    'email',
    'pass',
    'rol',
    'activo'
     ];

 protected $useTimestamps = false; // Si no usas timestamps, déjalo en false

 protected $returnType = 'array'; // O 'object' si prefieres objetos

 public function validarUsuario($email, $pass)
    {
        $usuario = $this->select('id_usuario, email, pass, nombre, rol')
                        ->where(['email' => $email, 'activo' => 1])
                        ->first();

        if ($usuario && password_verify($pass, $usuario['pass'])) {
            return $usuario;
        }

        return null;
    }
 
}
?>