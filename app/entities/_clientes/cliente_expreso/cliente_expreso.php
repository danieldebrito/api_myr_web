<?php
class cliente_expreso
{
	public $idClienteExpreso;
	public $idCliente;
	public $idExpreso;
	
  	public static function readAll () {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT * FROM `cliente_expresos`"
			);
			$consulta->execute();
					
			$ret =  $consulta->fetchAll(PDO::FETCH_CLASS, "cliente_expreso");
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
				"SELECT * FROM `cliente_expresos` WHERE idCliente = $id"
			);
			$consulta->execute();
			$ret = $consulta->fetchObject("cliente_expreso");
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
				"INSERT INTO `cliente_expresos`
				(`idCliente`, `idExpreso`)
				VALUES
				(:idCliente, :idExpreso )"
			);
			$consulta->bindValue(':idCliente', $this->idCliente, PDO::PARAM_STR);
			$consulta->bindValue(':idExpreso', $this->idExpreso, PDO::PARAM_STR);
			
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
				"UPDATE `cliente_expresos` SET 
				`idCliente` = :idCliente, 
                `idExpreso` = :idExpreso
				WHERE `idClienteExpreso` = :idClienteExpreso");
                
				$consulta->bindValue(':idClienteExpreso', $this->idClienteExpreso, PDO::PARAM_STR);
				$consulta->bindValue(':idCliente', $this->idCliente, PDO::PARAM_STR);
				$consulta->bindValue(':idExpreso', $this->idExpreso, PDO::PARAM_STR);

	  			return $consulta->execute();
	}
	
	public static function delete($id){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta(
				"DELETE FROM `cliente_expresos` 
				WHERE `idClienteExpreso` = $id"
				);
            $consulta->bindValue(':idClienteExpreso', $id, PDO::PARAM_STR);
            $consulta->execute();
            $respuesta = array("Estado" => true, "Mensaje" => "Eliminado Correctamente");

        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => false, "Mensaje" => "$mensaje");

        } finally {
            return $respuesta;
        }
	}
}


