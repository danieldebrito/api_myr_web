<?php
class combustible{
	public $id_combustible;
	public $combustible;
	
  	public static function readAll () {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT * FROM `combustibles`"
			);
			$consulta->execute();
					
			$ret =  $consulta->fetchAll(PDO::FETCH_CLASS, "combustible");
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
				"SELECT * FROM `combustibles` WHERE id_combustible = $id"
			);
			$consulta->execute();
			$ret = $consulta->fetchObject("combustible");
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
				"INSERT INTO `combustibles`
				(`id_combustible`, `combustible`)
				VALUES
				(:id_combustible, :combustible)"
			);

			$consulta->bindValue(':id_combustible', $this->id_combustible, PDO::PARAM_STR);
			$consulta->bindValue(':combustible', $this->combustible, PDO::PARAM_STR);
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
				"UPDATE `combustibles` SET 
				`combustible` = :combustible
				WHERE `id_combustible` = :id_combustible");
                
				$consulta->bindValue(':id_combustible', $this->id_combustible, PDO::PARAM_STR);
				$consulta->bindValue(':combustible', $this->combustible, PDO::PARAM_STR);


        return $consulta->execute();
	}

	public static function delete($id){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta(
				"DELETE FROM `combustibles` 
				WHERE `id_combustible` = $id"
				);
            $consulta->bindValue(':id_combustible', $id, PDO::PARAM_STR);
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

