<?php
class aplicacion
{
    public $id_aplicacion;
    public $codigo_app;
    public $aplicacion;
    public $activo;

    public static function readAll(){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			SELECT * FROM `aplicaciones` WHERE 1
			");
            $consulta->execute();
            $ret = $consulta->fetchAll(PDO::FETCH_CLASS, "aplicacion");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
    }

    public static function read($id_aplicacion){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			SELECT *
			FROM `aplicaciones`
			WHERE `id_aplicacion` = '$id_aplicacion'
			");
            $consulta->execute();
            $ret = $consulta->fetchObject('aplicacion');
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
    }

    public function create()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			INSERT INTO `aplicaciones`
				(`id_aplicacion`,
				`codigo_app`,
				`aplicacion`,
                `activo`)
			VALUES (
				:id_aplicacion,
				:codigo_app,
				:aplicacion,
                :activo)
		");

            $consulta->bindValue(':id_aplicacion', $this->id_aplicacion, PDO::PARAM_STR);
            $consulta->bindValue(':codigo_app', $this->codigo_app, PDO::PARAM_STR);
            $consulta->bindValue(':aplicacion', $this->aplicacion, PDO::PARAM_STR);
            $consulta->bindValue(':activo', $this->activo, PDO::PARAM_INT);

            $consulta->execute();
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }
    }

    public static function delete($id_aplicacion){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
                DELETE FROM `aplicaciones` 
                WHERE `id_aplicacion` = '$id_aplicacion'
            ");
            $consulta->bindValue(':id_aplicacion', $id_aplicacion, PDO::PARAM_STR);
            $consulta->execute();
            $respuesta = array("Estado" => true, "Mensaje" => "Eliminado Correctamente");

        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => false, "Mensaje" => "$mensaje");

        } finally {
            return $respuesta;
        }
    }

    public function update()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("
                UPDATE `aplicaciones` 
                SET 
				`codigo_app`=:codigo_app, 
                `aplicacion`=:aplicacion, 
                `activo`=:activo 
                WHERE id_aplicacion=:id_aplicacion");
                
                $consulta->bindValue(':id_aplicacion', $this->id_aplicacion, PDO::PARAM_STR);
                $consulta->bindValue(':codigo_app', $this->codigo_app, PDO::PARAM_STR);
                $consulta->bindValue(':aplicacion', $this->aplicacion, PDO::PARAM_STR);
                $consulta->bindValue(':activo', $this->activo, PDO::PARAM_INT);
        
        return $consulta->execute();
    }
}
