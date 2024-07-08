
<?php
class blogContr extends blog {
    private $idBlog;
    private $titulo;
    private $cuerpo;
    private $fotoURL;
    private $fotoALT;
    private $fecha;
    private $idUsuario;
    private $tablaNombre = "blogs";
    public $tablaNumReg = 0;

    public function __construct($idBlog,$titulo,$cuerpo,$fotoURL,$fotoALT,$fecha,$idUsuario) {
                $this->idBlog = $idBlog;
                $this->titulo = $titulo;
                $this->cuerpo = $cuerpo;
                $this->fotoURL = $fotoURL;
                $this->fotoALT = $fotoALT;
                $this->fecha = $fecha;
                $this->idUsuario = $idUsuario;
                } 


    public function __destruct() { 
            echo "Se ha destruido el usuario";
            }

// setters y getters
    public function getidBlog() {
            return $this->idBlog;
            }
    public function getTitulo() {
            return $this->titulo;
            }
    public function getCuerpo() {
            return $this->cuerpo;
            }
    public function getFotoURL() {
            return $this->fotoURL;
            }
    public function getFotoALT() {
            return $this->fotoURL;
            }
    public function getFecha() {
            return $this->fecha;
            }
    public function getIdUsuario() {
            return $this->idUsuario;
            }

    public function setIdBlog($idBlog) {
            $this->idBlog = $idBlog;
            }
    public function setTitulo($titulo) {
            $this->titulo = $titulo;
            }
    public function setCuerpo($cuerpo) {
            $this->cuerpo = $cuerpo;
            }
    public function setFotoURL($fotoURL) {
            $this->fotoURL = $fotoURL;
            }
    public function setFotoALT($fotoALT) {
            $this->fotoALT = $fotoALT;
            }
    public function setFecha($fecha) {
            $this->fecha = $fecha;
            }
    public function setidUsuario($idUsuario) {
            $this->idUsuario = $idUsuario;
            }
        }
    ?>