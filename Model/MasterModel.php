<?php
    include_once '../Lib/ConexionPG.php';

    class MasterModel extends Connection{
        public function insertar($sql)
        {   
            $respuesta=pg_query($this->getConnect(),$sql); 
            return $respuesta;
        }
        public function consultar($sql)
        {   
            $respuesta=pg_query($this->getConnect(),$sql);
            return $respuesta;
        }
        public function editar($sql)
        {   
            $respuesta=pg_query($this->getConnect(),$sql);
            return $respuesta;
        }
        public function eliminar($sql)
        {   
            $respuesta=pg_query($this->getConnect(),$sql);
            return $respuesta;
        }

        public function autoincrement($table,$field){
            $sql="SELECT MAX($field) FROM $table";//max me trae el numero maximo, tambien se puede con el order by
            $respuesta=$this->consultar($sql);
            $contador=pg_fetch_row($respuesta);//mysqli_fetch_row me sirve para convertir un array y forma numerica
            //add($contador);
            return $contador[0]+1;
        }
       
    }
?>