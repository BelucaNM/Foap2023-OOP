
<?php

class blog extends connection{

    private $tablaNombre = "blogs";
    public $blogsNumReg = 0;

    public function getTodos($idUsuario = "")
    {

        $result = true;
        if ($idUsuario == "") {
            $sql = "SELECT idBlog, titulo, cuerpo,  fotoURL, fotoALT, fecha, usuarios_idUsuario FROM " . $this->tablaNombre . " ORDER BY fecha DESC";
        } else {
            $sql = "SELECT idBlog, titulo, cuerpo,  fotoURL, fotoALT, fecha, usuarios_idUsuario FROM " . $this->tablaNombre . " WHERE idUsuario = '$idUsuario' ORDER BY fecha DESC";
        }

        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute();

        if (!$result) {
            return 1;
        }
        ;
        $this->tablaNumReg = $stmt->rowCount();
     
        return $stmt->fetchAll();
    }

    public function setBlog($titulo, $cuerpo, $fotoURL, $fotoALT, $fecha, $idUsuariol){

        $error = 0;
        $stmt = $this->connect()->prepare("INSERT INTO " . $this->tablaNombre . "(titulo,cuerpo,fotoURL,fotoALT,fecha,usuarios_idUsuario ) VALUES (?,?,?,?,?,?)");

        if (!$stmt) {
            $error = 1;
        }

        if (!$stmt->execute(array($titulo, $cuerpo, $fotoURL, $fotoALT, $fecha, $idUsuariol))) {
            $error = 2;
        }
     
        $stmt = null;
        return $error;
    
    }  
} 
?>