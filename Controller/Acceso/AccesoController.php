<?php 

    include_once '../Model/Acceso/AccesoModel.php';

    class AccesoController{

        

        public function login(){

            $user=$_POST['user'];
            $pass=$_POST['clave'];
            $obj= new AccesoModel();

            $sql= "SELECT U.usu_id, U.usu_primer_nombre, U.usu_primer_apellido, U.usu_nickname, U.usu_correo, U.rol_id, R.rol_nombre, U.estado_id "
		      ."FROM tbl_usuario AS U, tbl_rol AS R "
              ."WHERE U.usu_contrasena='".$pass."' AND (U.usu_nickname='".$user."' OR U.usu_correo='".$user."') AND U.rol_id = R.rol_id";
              
            $usuario=$obj->consultar($sql);

            $error = "";

            if (pg_num_rows($usuario)>0) {
                
                    while($usu=pg_fetch_assoc($usuario)){
                        if($usu['estado_id'] != 2){
                            $_SESSION['id']=$usu['usu_id'];
                            $_SESSION['rol']=$usu['rol_id'];		
                            $_SESSION['nombreRol']=$usu['rol_nombre'];		
                            $_SESSION['nombre']=$usu['usu_primer_nombre'];
                            $_SESSION['apellido']=$usu['usu_primer_apellido'];
                            $_SESSION['nickname']=$usu['usu_nickname'];
                            $_SESSION['correo']=$usu['usu_correo'];
                            $_SESSION['auth']="ok";	
                            
                            redirect("index.php");

                        }else{
                            $error = "el usuario definido se encuenta inhabilitado";

                            //echo $error;
                
                            redirect("login.php?error=".$error."");
                        }
                    }
                
                   
            }else{

                $error = "usuario y/o contrasena incorrectos";

                //echo $error;
                
                redirect("login.php?error=".$error."");
                
            }

            /*$hash_password = crypt($pass);
            echo $hash_password."<br>";
            $sql = "SELECT usu_contrasena FROM tbl_usuario WHERE estado_id = 1";
            $consultaContrasenas = $obj->consultar($sql);

            if(!function_exists('hash_equals'))
                {
                    function hash_equals($str1, $str2)
                    {
                        if(strlen($str1) != strlen($str2))
                        {
                            return false;
                        }
                        else
                        {
                            $res = $str1 ^ $str2;
                            $ret = 0;
                            for($i = strlen($res) - 1; $i >= 0; $i--)
                            {
                                $ret |= ord($res[$i]);
                            }
                            return !$ret;
                        }
                    }
                }

            while($contrasenas = pg_fetch_assoc($consultaContrasenas)){

                echo $contrasenas['usu_contrasena'];

                if(hash_equals($hash_password, crypt($contrasenas['usu_constrasena'], $hash_password))){
                    //echo "la contrasena existe";
                }else{
                    //echo "la contrasena no existe";
                }

            }*/


            

        }



    }

?>