<?php
class cliente
{
	public $idCliente;
	public $cuit;
	public $razonSocial;
	public $condFiscal; // enum
	public $retIIBBcoef;
	public $idDescuento;
	public $userNombre;
	public $email;
	public $clave;
	public $estado;

  	public static function readAll () {
		try {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta = $objetoAccesoDato->RetornarConsulta(
				"SELECT * FROM `clientes`"
			);
			$consulta->execute();
					
			$ret =  $consulta->fetchAll(PDO::FETCH_CLASS, "cliente");
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
				"SELECT * FROM `clientes` WHERE idCliente = $id"
			);
			$consulta->execute();
			$ret = $consulta->fetchObject("cliente");
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
				"INSERT INTO `clientes`
				(`idCliente`, 
				`cuit`, 
				`razonSocial`,
				`condFiscal`,
				`retIIBBcoef`,
				`idDescuento`,
				`userNombre`,
				`email`, 
				`clave`, 
				`estado`)
				VALUES
				(:idCliente, 
				:cuit, 
				:razonSocial, 
				:condFiscal, 
				:retIIBBcoef, 
				:idDescuento, 
				:userNombre, 
				:email, 
				:clave, 
				:estado)"
			);
			$consulta->bindValue(':idCliente', $this->idCliente, PDO::PARAM_STR);
			$consulta->bindValue(':cuit', $this->cuit, PDO::PARAM_STR);
			$consulta->bindValue(':razonSocial', $this->razonSocial, PDO::PARAM_STR);
			$consulta->bindValue(':condFiscal', $this->condFiscal, PDO::PARAM_STR);
			$consulta->bindValue(':retIIBBcoef', $this->retIIBBcoef, PDO::PARAM_STR);
			$consulta->bindValue(':idDescuento', $this->idDescuento, PDO::PARAM_STR);
			$consulta->bindValue(':userNombre', $this->userNombre, PDO::PARAM_STR);
			$consulta->bindValue(':email', $this->email, PDO::PARAM_STR);
			$consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
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
				"UPDATE `clientes` SET 
				`cuit` = :cuit, 
                `razonSocial` = :razonSocial, 
				`condFiscal` = :condFiscal, 
				`retIIBBcoef` = :retIIBBcoef, 
				`idDescuento` = :idDescuento, 
				`userNombre` = :userNombre, 
                `email` = :email,
				`clave` = :clave,
				`estado` = :estado
				WHERE `idCliente` = :idCliente");
                
	$consulta->bindValue(':idCliente', $this->idCliente, PDO::PARAM_STR);
	$consulta->bindValue(':cuit', $this->cuit, PDO::PARAM_STR);
	$consulta->bindValue(':razonSocial', $this->razonSocial, PDO::PARAM_STR);
	$consulta->bindValue(':condFiscal', $this->condFiscal, PDO::PARAM_STR);
	$consulta->bindValue(':retIIBBcoef', $this->retIIBBcoef, PDO::PARAM_STR);
	$consulta->bindValue(':idDescuento', $this->idDescuento, PDO::PARAM_STR);
	$consulta->bindValue(':userNombre', $this->userNombre, PDO::PARAM_STR);
	$consulta->bindValue(':email', $this->email, PDO::PARAM_STR);
	$consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
	$consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
        
        return $consulta->execute();
    }

	public static function delete($id){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta(
				"DELETE FROM `clientes` 
				WHERE `id` = $id"
				);
            $consulta->bindValue(':id', $id, PDO::PARAM_STR);
            $consulta->execute();
            $respuesta = array("Estado" => true, "Mensaje" => "Eliminado Correctamente");

        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => false, "Mensaje" => "$mensaje");

        } finally {
            return $respuesta;
        }
    }

	public function Login($id, $clave) {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta(
			"SELECT * FROM `clientes` WHERE `id`= '".$id."' AND `clave`= '".$clave."'"
		);

		$consulta->execute();
		$resultado = $consulta->fetch();
        return $resultado;
    }
}

