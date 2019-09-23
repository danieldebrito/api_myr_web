<?php
class pedido
{
	public $id_pedido;
	public $id_cliente;
	public $id_sucursal;
	public $id_expreso;
	public $estado;
	public $envio;
	public $fecha;
	public $observaciones;
	
  	public static function readAll () {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT * FROM `pedidos`"
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

	public static function read($id) {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT * FROM `pedidos` WHERE id_pedido = $id"
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
				(`id_cliente`, `id_sucursal`, `id_expreso`, `estado`, `envio`, `fecha`, `observaciones`)
				VALUES
				(:id_cliente, :id_sucursal, :id_expreso, :estado, :envio, :fecha, :observaciones)"
			);

			// $consulta->bindValue(':id_pedido', $this->id_pedido, PDO::PARAM_INT); AI
			$consulta->bindValue(':id_cliente', $this->id_cliente, PDO::PARAM_STR);
			$consulta->bindValue(':id_sucursal', $this->id_sucursal, PDO::PARAM_STR);
			$consulta->bindValue(':id_expreso', $this->id_expreso, PDO::PARAM_STR);
			$consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
			$consulta->bindValue(':envio', $this->envio, PDO::PARAM_STR);
			$consulta->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);
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
				`id_cliente` = :id_cliente, 
                `id_sucursal` = :id_sucursal,
				`id_expreso` = :id_expreso, 
                `estado` = :estado,
				`envio` = :envio, 
                `fecha` = :fecha,
				`observaciones` = :observaciones
				WHERE `id_pedido` = :id_pedido");
                
			$consulta->bindValue(':id_pedido', $this->id_pedido, PDO::PARAM_INT);
			$consulta->bindValue(':id_cliente', $this->id_cliente, PDO::PARAM_STR);
			$consulta->bindValue(':id_sucursal', $this->id_sucursal, PDO::PARAM_STR);
			$consulta->bindValue(':id_expreso', $this->id_expreso, PDO::PARAM_STR);
			$consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
			$consulta->bindValue(':envio', $this->envio, PDO::PARAM_STR);
			$consulta->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);
			$consulta->bindValue(':observaciones', $this->observaciones, PDO::PARAM_STR);

        return $consulta->execute();
	}

	public static function delete($id){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta(
				"DELETE FROM `pedidos` 
				WHERE `id_pedido` = $id"
				);
            $consulta->bindValue(':id_pedido', $id, PDO::PARAM_STR);
            $consulta->execute();
            $respuesta = array("Estado" => true, "Mensaje" => "Eliminado Correctamente");

        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => false, "Mensaje" => "$mensaje");

        } finally {
            return $respuesta;
        }
	}

	/////////////////////////////////////-----////////////////////////////////////////////////////

	public static function traePedidoAbierto($id) {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT * FROM `pedidos` WHERE `id_cliente` = $id AND `estado` = 'abierto'"
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

	public static function readAllCliente ($id) {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT * FROM `pedidos` WHERE `id_cliente` = $id"
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
}

