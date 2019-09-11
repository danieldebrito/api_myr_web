<?php
class pedido_detalle
{
	public $id_pedido_detalle;
	public $id_pedido;
	public $id_articulo;
	public $cantidad;
	
  	public static function readAll () {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT * FROM `pedidos_detalle`"
			);
			$consulta->execute();
					
			$ret =  $consulta->fetchAll(PDO::FETCH_CLASS, "pedido_detalle");
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
				"SELECT * FROM `pedidos_detalle` WHERE id_pedido_detalle = $id"
			);
			$consulta->execute();
			$ret = $consulta->fetchObject("pedido_detalle");
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
				"INSERT INTO `pedidos_detalle`
				(`id_pedido`, `id_articulo`, `cantidad`)
				VALUES
				(:id_pedido, :id_articulo, :cantidad)"
			);
			// $consulta->bindValue(':id_pedido_detalle', $this->id_pedido_detalle, PDO::PARAM_INT); ai
			$consulta->bindValue(':id_pedido', $this->id_pedido, PDO::PARAM_STR);
			$consulta->bindValue(':id_articulo', $this->id_articulo, PDO::PARAM_STR);
			$consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);
			
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
				"UPDATE `pedidos_detalle` SET 
				`id_pedido` = :id_pedido, 
				`id_articulo` = :id_articulo, 
                `cantidad` = :cantidad
				WHERE `id_pedido_detalle` = :id_pedido_detalle");
                
				$consulta->bindValue(':id_pedido_detalle', $this->id_pedido_detalle, PDO::PARAM_INT);
				$consulta->bindValue(':id_pedido', $this->id_pedido, PDO::PARAM_STR);
				$consulta->bindValue(':id_articulo', $this->id_articulo, PDO::PARAM_STR);
				$consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);

        return $consulta->execute();
	}
	
	public static function delete($id){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta(
				"DELETE FROM `pedidos_detalle` 
				WHERE `id_pedido_detalle` = $id"
				);
            $consulta->bindValue(':id_pedido_detalle', $id, PDO::PARAM_STR);
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

