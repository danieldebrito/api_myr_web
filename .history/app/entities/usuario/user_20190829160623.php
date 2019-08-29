<?php
class user
{
	public $id_user;
	public $nombre;
	public $apellido;
	public $userName;
	public $pass;
	public $estado;  // { activo, inactivo, suspendido }
	public $rol; // { admin, empleado, cliente, supervisor }


	public static function readAll(){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT * FROM `users` WHERE 1   
			");
            $consulta->execute();
            $ret = $consulta->fetchAll(PDO::FETCH_CLASS, "user");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
    }

    public static function read($id_user){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT *
				FROM `users`
				WHERE `id_user` = '$id_user'
			");
            $consulta->execute();
            
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
			$ret = $consulta->fetchObject('user');

            return $ret;
        }
	}

    public function create()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta(
				"INSERT INTO `users`
				(`id_user`,
				`nombre`,
				`apellido`,
				`userName`,
				`pass`,
				`estado`,
                `rol`)
			VALUES (
				:id_user,
				:nombre,
				:apellido,
				:userName,
				:pass,
				:estado,
                :rol)
		");

            $consulta->bindValue(':id_user', $this->id_user, PDO::PARAM_STR);
			$consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
			$consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
			$consulta->bindValue(':userName', $this->userName, PDO::PARAM_STR);
			$consulta->bindValue(':pass', $this->pass, PDO::PARAM_STR);
			$consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
			$consulta->bindValue(':rol', $this->rol, PDO::PARAM_STR);

            $consulta->execute();
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }
    }

    public static function delete($id_user){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta(
				"DELETE FROM `users` 
                WHERE `id_user` = '$id_user'
            ");
            $consulta->bindValue(':id_user', $id_user, PDO::PARAM_STR);
            $consulta->execute();
            $respuesta = array("Estado" => true, "Mensaje" => "Eliminado Correctamente");

        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => false, "Mensaje" => "$mensaje");

        } finally {
            return $respuesta;
        }
	}
	
		
	/*
		public $id_user;
	public $nombre;
	public $apellido;
	public $userName;
	public $pass;
	public $estado;  // { activo, inactivo, suspendido }
	public $rol;
	*/


    public function update()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta(
			    "UPDATE `users` 
                SET 
				`nombre`=:nombre, 
                `apellido`=:apellido, 
                `userName`=:userName, 
                `pass`=:pass,
				`estado`=:estado,
				`rol`=:rol
                WHERE id_user=:id_user");
                
				$consulta->bindValue(':id_user', $this->id_user, PDO::PARAM_STR);
				$consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
                $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
                $consulta->bindValue(':userName', $this->userName, PDO::PARAM_STR);
                $consulta->bindValue(':pass', $this->pass, PDO::PARAM_STR);
                $consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
                $consulta->bindValue(':rol', $this->rol, PDO::PARAM_STR);

        return $consulta->execute();
    }
}

/*

  	public static function selectAll () {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta = $objetoAccesoDato->RetornarConsulta("
			SELECT * FROM `usuarios` WHERE 1
		");
		$consulta->execute();
				
		return $consulta->fetchAll(PDO::FETCH_CLASS, "user");		
	}

	public static function selectOne($id) {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta = $objetoAccesoDato->RetornarConsulta("
		SELECT * FROM `usuarios` WHERE idUsuario = $id
		");
		$consulta->execute();
		return $consulta->fetchObject("user");
	}

	public function setOne() {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("
		INSERT INTO `usuarios`
		(`idUsuario`, `nombre`, `email`, `clave`, `estado`, `rol`)
		VALUES
		(:idUsuario,:nombre, :email, :clave, :estado, :rol)
		");
		$consulta->bindValue(':idUsuario', $this->idUsuario, PDO::PARAM_STR);
		$consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':email', $this->email, PDO::PARAM_STR);
		$consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
		$consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
		$consulta->bindValue(':rol', $this->rol, PDO::PARAM_STR);
		
		return $consulta->execute();
	}

	public function Login($nombre, $clave) {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("
		SELECT * FROM `usuarios` WHERE `nombre`= '".$nombre."' AND `clave`= '".$clave."'
		");

		$consulta->execute();
		$resultado = $consulta->fetch();

        return $resultado;
    }

}

*/