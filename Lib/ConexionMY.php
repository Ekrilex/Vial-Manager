<?php 

    /*conexion a una base de datos de postgres desde php*/

class connection{

    private $server; 
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

        require_once 'Conf/confMY.php';

        $this->server = $server;
        $this->port = $port;
        $this->database = $database;
        $this->user = $user;
        $this->pass = $pass;

    }

    private function connect(){

        $this->link = mysqli_connect($this->server,$this->user,  $this->pass, $this->database );

        if(!$this->link){
            die(mysqli_error($this->link));
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
        mysqli_close($this.link);
    }


}



?>