<?php
class cliente_sucursal{
	public $id_sucursal;
	public $id_cliente;
	public $nombre_sucursal;
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
				"SELECT * FROM `cliente_sucursales` WHERE id_sucursal = $id"
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
				( `id_cliente`,
				 `nombre_sucursal`,
				 `calle`,
				 `numero`,
				 `cp`,
				 `localidad`,
				 `provincia`)
				VALUES
				(:id_cliente, 
				 :nombre_sucursal, 
				 :calle, 
				 :numero, 
				 :cp,
				 :localidad,
				 :provincia)"
			);

			// $consulta->bindValue(':id_sucursal', $this->id_sucursal, PDO::PARAM_STR);
			$consulta->bindValue(':id_cliente', $this->id_cliente, PDO::PARAM_STR);
			$consulta->bindValue(':nombre_sucursal', $this->nombre_sucursal, PDO::PARAM_STR);
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
				`id_cliente` = :id_cliente, 
				`nombre_sucursal` = :nombre_sucursal, 
				`calle` = :calle, 
				`numero` = :numero, 
				`cp` = :cp, 
				`localidad` = :localidad, 
				`provincia` = :provincia 
				WHERE `id_sucursal` = :id_sucursal");
                
				$consulta->bindValue(':id_sucursal', $this->id_sucursal, PDO::PARAM_INT);
				$consulta->bindValue(':id_cliente', $this->id_cliente, PDO::PARAM_STR);
				$consulta->bindValue(':nombre_sucursal', $this->nombre_sucursal, PDO::PARAM_STR);
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
				WHERE `id_sucursal` = $id"
				);
            $consulta->bindValue(':id_sucursal', $id, PDO::PARAM_STR);
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
				"SELECT * FROM `cliente_sucursales` WHERE `id_cliente` = $id"
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
}

