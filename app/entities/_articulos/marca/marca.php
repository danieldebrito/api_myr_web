<?php
class marca
{
	public $id_marca;
	public $id_linea;
	public $marca;
	public $rotacion;
	
  	public static function readAll () {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT * FROM `marcas`"
			);
			$consulta->execute();
					
			$ret =  $consulta->fetchAll(PDO::FETCH_CLASS, "marca");
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
				"SELECT * FROM `marcas` WHERE id_marca = $id"
			);
			$consulta->execute();
			$ret = $consulta->fetchObject("marca");
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
				"INSERT INTO `marcas`
				(`id_marca`, `id_linea`, `marca`, `rotacion`)
				VALUES
				(:id_marca, :id_linea, :marca, :rotacion)"
			);

			$consulta->bindValue(':id_marca', $this->id_marca, PDO::PARAM_INT);
			$consulta->bindValue(':id_linea', $this->id_linea, PDO::PARAM_STR);
			$consulta->bindValue(':marca', $this->marca, PDO::PARAM_STR);
			$consulta->bindValue(':rotacion', $this->rotacion, PDO::PARAM_STR);
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
				"UPDATE `marcas` SET 
				`id_linea` = :id_linea,
				`marca` = :marca,
				`rotacion` = :rotacion
				WHERE `id_marca` = :id_marca");
                
				$consulta->bindValue(':id_marca', $this->id_marca, PDO::PARAM_STR);
				$consulta->bindValue(':id_linea', $this->id_linea, PDO::PARAM_STR);
				$consulta->bindValue(':marca', $this->marca, PDO::PARAM_STR);
				$consulta->bindValue(':rotacion', $this->rotacion, PDO::PARAM_STR);

        return $consulta->execute();
	}
	
	public static function delete($id){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta(
				"DELETE FROM `marcas` 
				WHERE `id_marca` = $id"
				);
            $consulta->bindValue(':id_marca', $id, PDO::PARAM_STR);
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

