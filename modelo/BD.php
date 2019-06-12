<?php

  class BD {

    private $host  = "localhost";
    private $usuario  = "root";
    private $senha  = "";
    private $banco = "lojavirtual";

    public function conectar() {
      try {
        $bd = new PDO("mysql:host=$this->host;dbname=$this->banco", $this->usuario, $this->senha);
       
      } catch( PDOException $e ) {
        $e->getMessage();
      }

      return $bd;
    } 

  }

?>