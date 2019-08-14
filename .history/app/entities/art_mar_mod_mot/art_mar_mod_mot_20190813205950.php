<?php
class art_mar_mod_mot
{
    public $id_articulo;
    public $id_mar_mod;
    public $id_motor;

    public static function readAll()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta
                ("SELECT art.id_articulo, mmm.id_mar_mod, amo.id_motor
            FROM art_mar_mod_mot amo, mar_mod_mot mmm, articulos art
            WHERE amo.id_motor = mmm.id_motor
            AND amo.id_articulo = SUBSTRING(art.id_articulo, 1, 7)
            LIMIT 30
			");
            $consulta->execute();
            $ret = $consulta->fetchAll(PDO::FETCH_CLASS, "art_mar_mod_mot");

        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
    }

    public static function readParams($id_articulo, $id_mar_mod, $id_motor)
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta
                ("SELECT art.id_articulo, mmm.id_mar_mod, amo.id_motor
                FROM art_mar_mod_mot amo, mar_mod_mot mmm, articulos art
                WHERE amo.id_motor = mmm.id_motor
                AND amo.id_articulo = SUBSTRING(art.id_articulo, 1, 7)
                AND SUBSTRING(amo.id_articulo, 1, 7) = '01-2870'
                AND mmm.id_mar_mod = '299'
                AND amo.id_motor = '30'
                LIMIT 30
                ");
            $consulta->execute();
            $ret = $consulta->fetchAll(PDO::FETCH_CLASS, "art_mar_mod_mot");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
    }

    public function instruccionFiltro($linea, $marca, $combustible, $motor, $modelo, $cilindrada, $competicion, $producto, $aplicacion)
    {

        $instr = 'SELECT * FROM `articulos`';
        $flag = true;

        if ($linea != null) {
            if ($flag) {
                $flag = !$flag;
                $instr = $instr . ' WHERE ' . 'linea = ' . "'" . $linea . "'";
            } else {
                $instr = $instr . ' AND ' . 'linea = ' . "'" . $linea . "'";
            }
        }

        if ($marca != null) {
            if ($flag) {
                $instr = $instr . ' WHERE ' . 'marca = ' . "'" . $marca . "'";
                $flag = !$flag;
            } else {
                $instr = $instr . ' AND ' . 'marca = ' . "'" . $marca . "'";
            }
        }

        if ($combustible != null) {
            if ($flag) {
                $flag = !$flag;
                $instr = $instr . ' WHERE ' . 'combustible = ' . "'" . $combustible . "'";
            } else {
                $instr = $instr . ' AND ' . 'combustible = ' . "'" . $combustible . "'";
            }
        }

        if ($motor != null) {
            if ($flag) {
                $flag = !$flag;
                $instr = $instr . ' WHERE ' . 'motor = ' . "'" . $motor . "'";
            } else {
                $instr = $instr . ' AND ' . 'motor = ' . "'" . $motor . "'";
            }
        }

        if ($modelo != null) {
            if ($flag) {
                $flag = !$flag;
                $instr = $instr . ' WHERE ' . 'modelo = ' . "'" . $modelo . "'";
            } else {
                $instr = $instr . ' AND ' . 'modelo = ' . "'" . $modelo . "'";
            }
        }

        if ($cilindrada != null) {
            if ($flag) {
                $flag = !$flag;
                $instr = $instr . ' WHERE ' . 'cilindrada = ' . "'" . $cilindrada . "'";
            } else {
                $instr = $instr . ' AND ' . 'cilindrada = ' . "'" . $cilindrada . "'";
            }
        }

        if ($competicion != null) {
            if ($flag) {
                $flag = !$flag;
                $instr = $instr . ' WHERE ' . 'competicion = ' . "'" . $competicion . "'";
            } else {
                $instr = $instr . ' AND ' . 'competicion = ' . "'" . $competicion . "'";
            }
        }

        if ($producto != null) {
            if ($flag) {
                $flag = !$flag;
                $instr = $instr . ' WHERE ' . 'producto = ' . "'" . $producto . "'";
            } else {
                $instr = $instr . ' AND ' . 'producto = ' . "'" . $producto . "'";
            }
        }

        if ($aplicacion != null) {
            if ($flag) {
                $flag = !$flag;
                $instr = $instr . ' WHERE ' . 'aplicacion = ' . "'" . $aplicacion . "'";
            } else {
                $instr = $instr . ' AND ' . 'aplicacion = ' . "'" . $aplicacion . "'";
            }
        }

        // var_dump('INSTRUCCION SQL: '.$instr);

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("
			$instr
		");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, "Articulo");
    }
}

/*

public static function read($id_producto){
try {
$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
$consulta = $objetoAccesoDato->RetornarConsulta("
SELECT *
FROM `productos`
WHERE `id_producto` = '$id_producto'
");
$consulta->execute();
$ret = $consulta->fetchObject('producto');
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
INSERT INTO `productos`
(`id_producto`,
`id_sector`,
`producto`,
`tiempo_preparacion`,
`precio`)
VALUES (
:id_producto,
:id_sector,
:producto,
:tiempo_preparacion,
:precio)
");

$consulta->bindValue(':id_producto', $this->id_producto, PDO::PARAM_STR);
$consulta->bindValue(':id_sector', $this->id_sector, PDO::PARAM_STR);
$consulta->bindValue(':producto', $this->producto, PDO::PARAM_STR);
$consulta->bindValue(':tiempo_preparacion', $this->tiempo_preparacion, PDO::PARAM_INT);
$consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);

$consulta->execute();
} catch (Exception $e) {
$mensaje = $e->getMessage();
$respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
} finally {
return $objetoAccesoDato->RetornarUltimoIdInsertado();
}
}

public static function delete($id_producto){
try {
$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
$consulta = $objetoAccesoDato->RetornarConsulta("
DELETE FROM `productos`
WHERE `id_producto` = '$id_producto'
");
$consulta->bindValue(':id_producto', $id_producto, PDO::PARAM_STR);
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
UPDATE `productos`
SET
`id_sector`=:id_sector,
`producto`=:producto,
`tiempo_preparacion`=:tiempo_preparacion,
`precio`=:precio
WHERE id_producto=:id_producto");

$consulta->bindValue(':id_producto', $this->id_producto, PDO::PARAM_STR);
$consulta->bindValue(':id_sector', $this->id_sector, PDO::PARAM_STR);
$consulta->bindValue(':producto', $this->producto, PDO::PARAM_STR);
$consulta->bindValue(':tiempo_preparacion', $this->tiempo_preparacion, PDO::PARAM_INT);
$consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);

return $consulta->execute();
}
 */
