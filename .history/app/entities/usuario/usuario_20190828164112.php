<?php
class usuario{
    public $id_usuario;
    public $nombre;
    public $apellido;
    public $usuario;
    public $pass;
    public $estado;  // { activo, inactivo, suspendido }
    public $rol; // { admin, user_sistema, user_web, supervisor }
}
