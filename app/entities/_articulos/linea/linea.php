<?php
class linea{
	public $id_linea;
	public $linea;
	
  	public static function readAll () {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT * FROM `lineas`"
			);
			$consulta->execute();
					
			$ret =  $consulta->fetchAll(PDO::FETCH_CLASS, "linea");
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
				"SELECT * FROM `lineas` WHERE id_linea = $id"
			);
			$consulta->execute();
			$ret = $consulta->fetchObject("linea");
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
				"INSERT INTO `lineas`
				(`id_linea`, `linea`)
				VALUES
				(:id_linea, :linea)"
			);

			$consulta->bindValue(':id_linea', $this->id_linea, PDO::PARAM_STR);
			$consulta->bindValue(':linea', $this->linea, PDO::PARAM_STR);
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
				"UPDATE `lineas` SET 
				`linea` = :linea
				WHERE `id_linea` = :id_linea");
                
				$consulta->bindValue(':id_linea', $this->id_linea, PDO::PARAM_STR);
				$consulta->bindValue(':linea', $this->linea, PDO::PARAM_STR);


        return $consulta->execute();
	}

	public static function delete($id){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta(
				"DELETE FROM `lineas` 
				WHERE `id_linea` = $id"
				);
            $consulta->bindValue(':id_linea', $id, PDO::PARAM_STR);
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

