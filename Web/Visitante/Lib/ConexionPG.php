<?php 

    /*conexion a una base de datos de postgres desde php*/

class connection{

    private $host; 
    private $port;
    private $database;
    private $user;
    private $pass;
    private $link;
    
    function __construct(){
        $this->setConnection();
        $this->connect();
    }

    private function setConnection(){

        require_once 'Conf/confPG.php';

        $this->host = $host;
        $this->port = $port;
        $this->database = $database;
        $this->user = $user;
        $this->pass = $pass;

    }

    private function connect(){

        $connectionString = "host=".$this->host." port=".$this->port." dbname=".$this->database." user=".$this->user." password=".$this->pass;
        /*el metodo PG_CONNECT recibe una cadena de texto donde 
        se da el parametro=valor de cada parametro que necesita
        para generar la conexion separados por un espacio en blanco*/

        $this->link = pg_connect($connectionString);

        if(!$this->link){
            echo "<script>".
            "alert('Error al conectar la base de datos');"
            ."</script>";
        }/*else{
            echo "<script>".
            "alert('conexion exitosa!');"
            ."</script>";
        }*/
    }

    public function getConnect(){
        return $this->link;
    }

    private function close(){
        pg_close($this.link);
    }


}

?>