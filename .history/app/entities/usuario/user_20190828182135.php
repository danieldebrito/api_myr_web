<?php
class user
{
	public $idUsuario;
	public $nombre;
	public $email;
	public $clave;
	public $estado;  // { activo, inactivo, suspendido }
	public $rol; // { admin, user_sistema, user_web, supervisor }



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

