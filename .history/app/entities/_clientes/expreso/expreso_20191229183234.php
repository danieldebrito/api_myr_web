<?php
class expreso
{
	public $id_expreso;
	public $id_direccion;
	public $nombre;
	
  	public static function readAll () {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT * FROM `expresos`"
			);
			$consulta->execute();
					
			$ret =  $consulta->fetchAll(PDO::FETCH_CLASS, "expreso");
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
				"SELECT * FROM `expresos` WHERE id_expreso = $id"
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

	public function create() {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta(
				"INSERT INTO `expresos`
				(`id_expreso`, `id_direccion`, `nombre`)
				VALUES
				(:id_expreso, :id_direccion, :nombre)"
			);
			$consulta->bindValue(':id_expreso', $this->id_expreso, PDO::PARAM_STR);
			$consulta->bindValue(':id_direccion', $this->id_direccion, PDO::PARAM_STR);
			$consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
			
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
				"UPDATE `expresos` SET 
				`id_direccion` = :id_direccion, 
                `nombre` = :nombre
				WHERE `id_expreso` = :id_expreso");
                
				$consulta->bindValue(':id_expreso', $this->id_expreso, PDO::PARAM_STR);
				$consulta->bindValue(':id_direccion', $this->id_direccion, PDO::PARAM_STR);
				$consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);

        return $consulta->execute();
    }

	public static function delete($id){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta(
				"DELETE FROM `expresos` 
				WHERE `id_expreso` = $id"
				);
            $consulta->bindValue(':id_expreso', $id, PDO::PARAM_STR);
            $consulta->execute();
            $respuesta = array("Estado" => true, "Mensaje" => "Eliminado Correctamente");

        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => false, "Mensaje" => "$mensaje");

        } finally {
            return $respuesta;
        }
	}

	public static function readByName($name) {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT * FROM `expresos` WHERE nombre = $name"
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

