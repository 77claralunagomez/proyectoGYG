<?php

    namespace App\Models; 
    use CodeIgniter\Model;

    /***Model es una extension de BaseModel para poder utilizar distintas funciones */
    class ConsultasModel extends Model{

    protected $table = 'consultas';  /**nombre de la tabla */
    protected $primaryKey = 'id_consulta';

    protected $allowedFields = [
        'id_usuario',
        'nombre',
        'apellido',
        'email',
        'mensaje',
        'activo'
        ];

    protected $useTimestamps = false; // Si no usas timestamps, déjalo en false

    protected $returnType = 'array'; // O 'object' si prefieres objetos
    
    }
?>