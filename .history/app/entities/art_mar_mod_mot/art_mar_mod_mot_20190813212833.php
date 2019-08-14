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

    public function readParams($id_articulo, $id_mar_mod, $id_motor)
    {

        $instruccionSQL =
        'SELECT art.id_articulo, mmm.id_mar_mod, amo.id_motor
        FROM art_mar_mod_mot amo, mar_mod_mot mmm, articulos art
        WHERE amo.id_motor = mmm.id_motor
        AND amo.id_articulo = SUBSTRING(art.id_articulo, 1, 7)';

        if ($id_articulo != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'id_articulo = ' . "'" . $id_articulo . "'";
        }

        if ($id_mar_mod != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'id_mar_mod = ' . "'" . $id_mar_mod . "'";
        }

        if ($id_motor != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'id_motor = ' . "'" . $id_motor . "'";
        }

        $instruccionSQL = $instruccionSQL . 'LIMIT 30';

        var_dump('INSTRUCCION SQL: '.$instruccionSQL);

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("
			$instruccionSQL
		");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, "art_mar_mod_mot");
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
