<?php
class cliente_sucursal{
	public $idSucursal;
	public $idCliente;
	public $idExpreso;
	public $nombreSucursal;
	public $calle;
	public $numero;
	public $cp;
	public $localidad;
	public $provincia;
 
  	public static function readAll () {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT * FROM `cliente_sucursales`"
			);
			$consulta->execute();
					
			$ret =  $consulta->fetchAll(PDO::FETCH_CLASS, "cliente_sucursal");
		} catch (Exception $e) {
			$mensaje = $e->getMessage();
			$respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
		} finally {
			return $ret;
		}		
	}

	public static function read($id) {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT * FROM `cliente_sucursales` WHERE idClienteSucursal = $id"
			);
			$consulta->execute();
			$ret = $consulta->fetchObject("cliente_sucursal");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
	}

	public function create() {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta(
				"INSERT INTO `cliente_sucursales`
				( `idCliente`,
				 `idExpreso`,
				 `nombreSucursal`,
				 `calle`,
				 `numero`,
				 `cp`,
				 `localidad`,
				 `provincia`)
				VALUES
				(:idCliente,
				 :idExpreso, 
				 :nombreSucursal, 
				 :calle, 
				 :numero, 
				 :cp,
				 :localidad,
				 :provincia)"
			);

			// $consulta->bindValue(':id_sucursal', $this->id_sucursal, PDO::PARAM_STR);
			$consulta->bindValue(':idCliente', $this->idCliente, PDO::PARAM_STR);
			$consulta->bindValue(':idExpreso', $this->idExpreso, PDO::PARAM_STR);
			$consulta->bindValue(':nombreSucursal', $this->nombreSucursal, PDO::PARAM_STR);
			$consulta->bindValue(':calle', $this->calle, PDO::PARAM_STR);
			$consulta->bindValue(':numero', $this->numero, PDO::PARAM_STR);
			$consulta->bindValue(':cp', $this->cp, PDO::PARAM_STR);
			$consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);
			$consulta->bindValue(':provincia', $this->provincia, PDO::PARAM_STR);
			
			$consulta->execute();

        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }
	}

	public function update(){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	
        $consulta = $objetoAccesoDato->RetornarConsulta(
				"UPDATE `cliente_sucursales` SET 
				`idCliente` = :idCliente,
				`idExpreso` = :idExpreso,  
				`nombreSucursal` = :nombreSucursal, 
				`calle` = :calle, 
				`numero` = :numero, 
				`cp` = :cp, 
				`localidad` = :localidad, 
				`provincia` = :provincia 
				WHERE `idSucursal` = :idSucursal");
                
				$consulta->bindValue(':idSucursal', $this->idSucursal, PDO::PARAM_INT);
				$consulta->bindValue(':idCliente', $this->idCliente, PDO::PARAM_STR);
				$consulta->bindValue(':idExpreso', $this->idExpreso, PDO::PARAM_STR);
				$consulta->bindValue(':nombreSucursal', $this->nombreSucursal, PDO::PARAM_STR);
				$consulta->bindValue(':calle', $this->calle, PDO::PARAM_STR);
				$consulta->bindValue(':numero', $this->numero, PDO::PARAM_STR);
				$consulta->bindValue(':cp', $this->cp, PDO::PARAM_STR);
				$consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);
				$consulta->bindValue(':provincia', $this->provincia, PDO::PARAM_STR);
        
        return $consulta->execute();
	}

	public static function delete($id){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta(
				"DELETE FROM `cliente_sucursales` 
				WHERE `idSucursal` = $id"
				);
            $consulta->bindValue(':idSucursal', $id, PDO::PARAM_STR);
            $consulta->execute();
            $respuesta = array("Estado" => true, "Mensaje" => "Eliminado Correctamente");

        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => false, "Mensaje" => "$mensaje");

        } finally {
            return $respuesta;
        }
	}
	
	public static function readAllCliente ($id) {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT * FROM `cliente_sucursales` WHERE `idCliente` = $id"
			);
			$consulta->execute();
					
			$ret =  $consulta->fetchAll(PDO::FETCH_CLASS, "cliente_sucursal");
		} catch (Exception $e) {
			$mensaje = $e->getMessage();
			$respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
		} finally {
			return $ret;
		}		
	}

	public static function readByName($name) {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT * FROM `cliente_sucursales` WHERE `nombreSucursal` =  $name"
			);
			$consulta->execute();
			$ret = $consulta->fetchObject("cliente_sucursal");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
	}

	public static function expresosByCliente($idCliente) {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT cliente_sucursales.idExpreso, expresos.nombre
				FROM cliente_sucursales, expresos
				WHERE cliente_sucursales.idCliente = $idCliente
				AND cliente_sucursales.idExpreso = expresos.id_expreso"
			);
			$consulta->execute();
			$ret = $consulta->fetchObject("expreso");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
	}
}

