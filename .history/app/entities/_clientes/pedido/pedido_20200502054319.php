<?php
class pedido
{
	public $idPedido;
	public $idClienteSucursal;
	public $idCliente;
	public $idExpreso;
	public $estado;
	public $fecha;
	public $idDescuento;
	public $subtotalNeto;
	public $observaciones;
	
  	public static function readAll () {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT * FROM `pedidos` ORDER BY `pedidos`.`idPedido` DESC"
			);
			$consulta->execute();
					
			$ret = $consulta->fetchAll(PDO::FETCH_CLASS, "pedido");
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
				"SELECT * FROM `pedidos` WHERE idPedido = $id ORDER BY `pedidos`.`idPedido` DESC"
			);
			$consulta->execute();
			$ret = $consulta->fetchObject("pedido");
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
				"INSERT INTO `pedidos`
				(`idClienteSucursal`,`idCliente`, `idExpreso`, `estado`, `fecha`, `idDescuento`, `subtotalNeto` ,`observaciones`)
				VALUES
				(:idClienteSucursal, :idCliente, :idExpreso, :estado, :fecha, :idDescuento, :subtotalNeto, :observaciones)"
			);

			// $consulta->bindValue(':id_pedido', $this->id_pedido, PDO::PARAM_INT); AI
			$consulta->bindValue(':idClienteSucursal', $this->idClienteSucursal, PDO::PARAM_INT);
			$consulta->bindValue(':idCliente', $this->idCliente, PDO::PARAM_STR);
			$consulta->bindValue(':idExpreso', $this->idExpreso, PDO::PARAM_INT);
			$consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
			$consulta->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);
			$consulta->bindValue(':idDescuento', $this->idDescuento, PDO::PARAM_STR);
			$consulta->bindValue(':subtotalNeto', $this->subtotalNeto, PDO::PARAM_INT);
			$consulta->bindValue(':observaciones', $this->observaciones, PDO::PARAM_STR);
			
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
				"UPDATE `pedidos` SET 
				`idClienteSucursal` = :idClienteSucursal,
                `idCliente` = :idCliente,
				`idExpreso` = :idExpreso, 
				`estado` = :estado, 
                `fecha` = :fecha,
				`idDescuento` = :idDescuento,
				`subtotalNeto` = :subtotalNeto,
				`observaciones` = :observaciones
				WHERE `idPedido` = :idPedido");
                
			$consulta->bindValue(':idPedido', $this->idPedido, PDO::PARAM_INT);
			$consulta->bindValue(':idClienteSucursal', $this->idClienteSucursal, PDO::PARAM_STR);
			$consulta->bindValue(':idCliente', $this->idCliente, PDO::PARAM_STR);
			$consulta->bindValue(':idExpreso', $this->idExpreso, PDO::PARAM_STR);
			$consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
			$consulta->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);
			$consulta->bindValue(':idDescuento', $this->idDescuento, PDO::PARAM_STR);
			$consulta->bindValue(':subtotalNeto', $this->subtotalNeto, PDO::PARAM_INT);
			$consulta->bindValue(':observaciones', $this->observaciones, PDO::PARAM_STR);

        return $consulta->execute();
	}

	public static function delete($id){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta(
				"DELETE FROM `pedidos` 
				WHERE `idPedido` = $id"
				);
            $consulta->bindValue(':idPedido', $id, PDO::PARAM_INT);
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
				"SELECT * FROM `pedidos` WHERE `idCliente`  = $id  AND `estado` <> 'abierto'  ORDER BY `pedidos`.`idPedido` DESC"
			);
			$consulta->execute();
					
			$ret =  $consulta->fetchAll(PDO::FETCH_CLASS, "pedido");
		} catch (Exception $e) {
			$mensaje = $e->getMessage();
			$respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
		} finally {
			return $ret;
		}		
	}

	public static function traePedidoAbierto ($id) {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT * FROM `pedidos` WHERE `idCliente`  = $id AND `estado` = 'abierto' ORDER BY `pedidos`.`idPedido` DESC"
			);
			$consulta->execute();
					
			$ret = $consulta->fetchObject("pedido");
		} catch (Exception $e) {
			$mensaje = $e->getMessage();
			$respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
		} finally {
			return $ret;
		}		
	}

}

