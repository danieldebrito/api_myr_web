<?php
class pedido_item
{
	public $id_pedido_item;
	public $id_cliente;
	public $id_pedido;
	public $id_articulo;
	public $cantidad;
	public $estado;

  	public static function readAll () {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT p.id_pedido_item, p.id_cliente, p.id_pedido, p.id_articulo, p.cantidad, p.estado, a.descripcion_corta, a.stock, a.precio_lista
				FROM articulos a, pedidos_item p
				WHERE a.id_articulo = p.id_articulo"
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
				"SELECT p.id_pedido_item, p.id_cliente, p.id_pedido, p.id_articulo, p.cantidad, p.estado, a.descripcion_corta, a.stock, a.precio_lista
				FROM articulos a, pedidos_item p
				WHERE a.id_articulo = p.id_articulo 
				AND p.id_pedido_item = $id"
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
				(`id_cliente`, `id_pedido`, `id_articulo`, `cantidad`, `estado`)
				VALUES
				(:id_cliente, :id_pedido, :id_articulo, :cantidad, :estado)"
			);
			// $consulta->bindValue(':id_pedido_item', $this->id_pedido_item, PDO::PARAM_INT); ai
			$consulta->bindValue(':id_cliente', $this->id_cliente, PDO::PARAM_STR);
			$consulta->bindValue(':id_pedido', $this->id_pedido, PDO::PARAM_INT);
			$consulta->bindValue(':id_articulo', $this->id_articulo, PDO::PARAM_STR);
			$consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);
			$consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
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
				"UPDATE `pedidos_item` SET 
				`id_cliente` = :id_cliente, 
				`id_pedido` = :id_pedido, 
				`id_articulo` = :id_articulo, 
				`cantidad` = :cantidad, 
                `estado` = :estado
				WHERE `id_pedido_item` = :id_pedido_item");
                
			$consulta->bindValue(':id_pedido_item', $this->id_pedido_item, PDO::PARAM_INT);
			$consulta->bindValue(':id_cliente', $this->id_cliente, PDO::PARAM_STR);
			$consulta->bindValue(':id_pedido', $this->id_pedido, PDO::PARAM_INT);
			$consulta->bindValue(':id_articulo', $this->id_articulo, PDO::PARAM_STR);
			$consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);
			$consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);

        return $consulta->execute();
	}
	
	public static function delete($id){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta(
				"DELETE FROM `pedidos_item` 
				WHERE `id_pedido_item` = $id"
				);
            $consulta->bindValue(':id_pedido_item', $id, PDO::PARAM_STR);
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
				"SELECT p.id_pedido_item, p.id_cliente, p.id_pedido, p.id_articulo, p.cantidad, p.estado, a.descripcion_corta, a.stock, a.precio_lista
				FROM articulos a, pedidos_item p
				WHERE a.id_articulo = p.id_articulo 
				AND p.id_cliente = $id"
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

	public static function readAllClienteAbierto ($id) {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT p.id_pedido_item, p.id_cliente, p.id_pedido, p.id_articulo, p.cantidad, p.estado, a.descripcion_corta, a.stock, a.precio_lista
				FROM articulos a, pedidos_item p
				WHERE a.id_articulo = p.id_articulo 
				AND p.id_cliente = $id 
				AND p.estado = 'abierto'"
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

	public function updateItems($id_pedido, $id_cliente){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta(
			"UPDATE `pedidos_item` 
			SET `id_pedido`= $id_pedido, `estado`= 'en_curso' 
			WHERE `id_cliente` = '$id_cliente'
			AND `estado` = 'abierto'");

        return $consulta->execute();
	}
}

