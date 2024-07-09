
<?php

class blog extends connection{

private $tablaNombre = "blogs";
public $blogsNumReg = 0;

public function getTodos($idUsuario="") {
            
        $result = true;
        if ($idUsuario == "") {
                $sql = "SELECT idBlog, titulo, cuerpo, password, fotoURL, fotoALT, fecha, idUsuario FROM ". $this->tablaNombre. " ORDER BY fecha DESC";
        }else {
                $sql = "SELECT idBlog, titulo, cuerpo, password, fotoURL, fotoALT, fecha, idUsuario FROM ". $this->tablaNombre. " WHERE idUsuario = '$idUsuario' ORDER BY fecha DESC";
        }

        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute();
        if (!$result ) { return 1;};
        $this->tablaNumReg = $stmt->rowCount();
        return $stmt->fetchAll();
    }

public function setBlog($idBlog,$titulo,$cuerpo,$fotoURL,$fotoALT,$fecha,$idUsuariol) {
            
    $result = true;
    $stmt = $this->connect()->prepare("INSERT INTO ". $this->tablaNombre. "(titulo,cuerpo,fotoURL,fotoALT,fecha,idUsuariol) VALUES (?,?,?,?,?,?)");

    if(!$stmt->execute(array($titulo,$cuerpo,$fotoURL,$fotoALT,$fecha,$idUsuariol))){
        $result = false;
    }
    if(!$stmt){
        $result = false;
        }
    $stmt = null;
    return $result;
    }  
}
    
?>