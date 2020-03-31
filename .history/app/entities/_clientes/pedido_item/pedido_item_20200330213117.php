<?php
class pedido_item
{
	public $idPedidoItem;
	public $idPedido;
	public $idCliente;
	public $idArticulo;
	public $cantidad;

  	public static function readAll () {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT * FROM `pedidos_item` WHERE 1"
			);
			$consulta->execute();
					
			$ret =  $consulta->fetchAll(PDO::FETCH_CLASS, "pedido_item");
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
				"SELECT * FROM `pedidos_item` WHERE `idPedidoItem` = $id"
			);
			$consulta->execute();
			$ret = $consulta->fetchObject("pedido_item");
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
				"INSERT INTO `pedidos_item`
				(`idPedido`,`idCliente`, `idArticulo`, `cantidad`)
				VALUES
				(:idPedido, :idCliente, :idArticulo, :cantidad)"
			);
			// $consulta->bindValue(':id_pedido_item', $this->id_pedido_item, PDO::PARAM_INT); ai
			$consulta->bindValue(':idPedido', $this->idPedido, PDO::PARAM_INT);
			$consulta->bindValue(':idCliente', $this->idCliente, PDO::PARAM_STR);
			$consulta->bindValue(':idArticulo', $this->idArticulo, PDO::PARAM_STR);
			$consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);
			$consulta->execute();

        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }
	}

	public function update() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta(
				"UPDATE `pedidos_item` SET 
				`idPedido` = :idPedido,
				`idCliente` = :idCliente,  
				`idArticulo` = :idArticulo, 
				`cantidad` = :cantidad
				WHERE `idPedidoItem` = :idPedidoItem");
                
			$consulta->bindValue(':idPedidoItem', $this->idPedidoItem, PDO::PARAM_INT);
			$consulta->bindValue(':idPedido', $this->idPedido, PDO::PARAM_INT);
			$consulta->bindValue(':idCliente', $this->idCliente, PDO::PARAM_STR);
			$consulta->bindValue(':idArticulo', $this->idArticulo, PDO::PARAM_STR);
			$consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);

        return $consulta->execute();
	}
	
	public static function delete($id) {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta(
				"DELETE FROM `pedidos_item` 
				WHERE `idPedidoItem` = $id"
				);
            $consulta->bindValue(':idPedidoItem', $id, PDO::PARAM_STR);
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
				"SELECT p.idPedidoItem, p.idCliente, p.idArticulo, p.cantidad, a.descripcion_corta, a.stock, a.precio_lista
				FROM articulos a, pedidos_item p
				WHERE a.id_articulo = p.idArticulo 
				AND p.idCliente = $id"
			);
			$consulta->execute();
					
			$ret =  $consulta->fetchAll(PDO::FETCH_CLASS, "pedido_item");
		} catch (Exception $e) {
			$mensaje = $e->getMessage();
			$respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
		} finally {
			return $ret;
		}		
	}
/**
 * id_pedido -1 significa que no pertenece a ningun pedido
 * es decir, falta cerrar el pedido y se reemplaza con el numero de pedido
 * generado una vez que el cliente cierra el pedido
 */
	public static function readAllClienteAbierto ($id) {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT p.idPedidoItem, p.idCliente, p.idPedido, p.idArticulo, p.cantidad, a.descripcion_corta, a.stock, a.precio_lista
				FROM articulos a, pedidos_item p
				WHERE a.id_articulo = p.idArticulo 
				AND p.idCliente = $id 
				AND p.idPedido = -1"
			);
			$consulta->execute();
					
			$ret =  $consulta->fetchAll(PDO::FETCH_CLASS, "pedido_item");
		} catch (Exception $e) {
			$mensaje = $e->getMessage();
			$respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
		} finally {
			return $ret;
		}		
	}

	public function updateItems($idPedido, $idCliente){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta(
			"UPDATE `pedidos_item` 
			SET `idPedido`= $idPedido 
			WHERE `idCliente` = '$idCliente'
			AND `idPedido` = -1");

        return $consulta->execute();
	}

	public static function subtotal($idCliente, $idPedido) {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT SUM(articulos.precio_lista * pedidos_item.cantidad) AS subtotal
				FROM pedidos_item, articulos
				WHERE pedidos_item.idArticulo = articulos.id_articulo
				AND pedidos_item.idCliente = $idCliente
				AND pedidos_item.idPedido = $idPedido"
			);
			$consulta->bindValue(':idCliente', $idCliente, PDO::PARAM_STR);
			$consulta->bindValue(':idPedido', $idPedido, PDO::PARAM_INT);

			$consulta->execute();
			$ret = $consulta->fetchObject();
        } catch (Exception $e) {
            $mensaje = $e->getMessage("pedido_item");
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
	}
}

