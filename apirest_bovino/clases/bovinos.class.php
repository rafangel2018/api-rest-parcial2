<?php
require_once "conexion/conexion.php";
require_once "respuestas.class.php";


class bovinos extends conexion {

    private $table = "bovinos";
    private $id = "";
    private $raza = "";
    private $fecha = "00-00-00";
    private $estado = "";
    private $preñado = "";
    private $peso = "";
    private $corporal = "";
    private $nacimiento = "";
    private $token = "";
//912bc00f049ac8464472020c5cd06759

    public function listaBovinos($pagina = 1){
        $inicio  = 0 ;
        $cantidad = 100;
        if($pagina > 1){
            $inicio = ($cantidad * ($pagina - 1)) +1 ;
            $cantidad = $cantidad * $pagina;
        }
        $query = "SELECT Id,Raza,Fecha,Estado,Peso,Corporal,Nacimiento FROM " . $this->table . " limit $inicio,$cantidad";
        $datos = parent::obtenerDatos($query);
        return ($datos);
    }

    public function obtenerBovino($id){
        $query = "SELECT * FROM " . $this->table . " WHERE Id = '$id'";
        return parent::obtenerDatos($query);

    }

    public function post($json){
        $_respuestas = new respuestas;
        $datos = json_decode($json,true);

        if(!isset($datos['token'])){
                return $_respuestas->error_401();
        }else{
            $this->token = $datos['token'];
            $arrayToken =   $this->buscarToken();
            if($arrayToken){

                if(!isset($datos['raza']) || !isset($datos['estado']) || !isset($datos['peso'])){
                    return $_respuestas->error_400();
                }else{
                    $this->raza = $datos['raza'];
                    $this->estado = $datos['estado'];
                    $this->peso = $datos['peso'];
                    if(isset($datos['fecha'])) { $this->fecha = $datos['fecha']; }
                    if(isset($datos['corporal'])) { $this->corporal = $datos['corporal']; }
                    if(isset($datos['nacimiento'])) { $this->nacimiento = $datos['nacimiento']; }
                    $resp = $this->insertarBovino();
                    if($resp){
                        $respuesta = $_respuestas->response;
                        $respuesta["result"] = array(
                            "id" => $resp
                        );
                        return $respuesta;
                    }else{
                        return $_respuestas->error_500();
                    }
                }

            }else{
                return $_respuestas->error_401("El Token que envio es invalido o ha caducado");
            }
        }


       

    }


    private function insertarBovino(){
        $query = "INSERT INTO " . $this->table . " (Raza,Fecha,Estado,Peso,Corporal,Nacimiento )
        values
        ('" . $this->raza . "','" . $this->fecha . "','" . $this->estado . "','"  . $this->peso . "','" . $this->corporal . "','" . $this->nacimiento . "')"; 
        $resp = parent::nonQueryId($query);
        if($resp){
             return $resp;
        }else{
            return 0;
        }
    }
    
    public function put($json){
        $_respuestas = new respuestas;
        $datos = json_decode($json,true);

        if(!isset($datos['token'])){
            return $_respuestas->error_401();
        }else{
            $this->token = $datos['token'];
            $arrayToken =   $this->buscarToken();
            if($arrayToken){
                if(!isset($datos['id'])){
                    return $_respuestas->error_400();
                }else{
                    $this->id = $datos['id'];
                    if(isset($datos['raza'])) { $this->raza = $datos['raza']; }
                    if(isset($datos['fecha'])) { $this->fecha = $datos['fecha']; }
                    if(isset($datos['estado'])) { $this->estado = $datos['estado']; }
                    if(isset($datos['peso'])) { $this->peso = $datos['peso']; }
                    if(isset($datos['corporal'])) { $this->corporal = $datos['corporal']; }
                    if(isset($datos['nacimiento'])) { $this->nacimiento = $datos['nacimiento']; }
        
                    $resp = $this->modificarBovino();
                    if($resp){
                        $respuesta = $_respuestas->response;
                        $respuesta["result"] = array(
                            "id" => $this->id
                        );
                        return $respuesta;
                    }else{
                        return $_respuestas->error_500();
                    }
                }

            }else{
                return $_respuestas->error_401("El Token que envio es invalido o ha caducado");
            }
        }


    }


    private function modificarBovino(){
        $query = "UPDATE " . $this->table . " SET Raza ='" . $this->raza . "',Fecha = '" . $this->fecha . "', Estado = '" . $this->estado . "', Peso = '" . $this->peso . "', Corporal = '" . $this->corporal . "', Nacimiento = '" . $this->nacimiento .
         "' WHERE id = '" . $this->id . "'"; 
        $resp = parent::nonQuery($query);
        if($resp >= 1){
             return $resp;
        }else{
            return 0;
        }
    }


    public function delete($json){
        $_respuestas = new respuestas;
        $datos = json_decode($json,true);

        if(!isset($datos['token'])){
            return $_respuestas->error_401();
        }else{
            $this->token = $datos['token'];
            $arrayToken =   $this->buscarToken();
            if($arrayToken){

                if(!isset($datos['id'])){
                    return $_respuestas->error_400();
                }else{
                    $this->id = $datos['id'];
                    $resp = $this->eliminarBovino();
                    if($resp){
                        $respuesta = $_respuestas->response;
                        $respuesta["result"] = array(
                            "id" => $this->id
                        );
                        return $respuesta;
                    }else{
                        return $_respuestas->error_500();
                    }
                }

            }else{
                return $_respuestas->error_401("El Token que envio es invalido o ha caducado");
            }
        }



     
    }


    private function eliminarBovino(){
        $query = "DELETE FROM " . $this->table . " WHERE Id= '" . $this->id . "'";
        $resp = parent::nonQuery($query);
        if($resp >= 1 ){
            return $resp;
        }else{
            return 0;
        }
    }


    private function buscarToken(){
        $query = "SELECT  TokenId,UsuarioId,Estado from usuarios_token WHERE Token = '" . $this->token . "' AND Estado = 'Activo'";
        $resp = parent::obtenerDatos($query);
        if($resp){
            return $resp;
        }else{
            return 0;
        }
    }


    private function actualizarToken($tokenid){
        $date = date("Y-m-d H:i");
        $query = "UPDATE usuarios_token SET Fecha = '$date' WHERE TokenId = '$tokenid' ";
        $resp = parent::nonQuery($query);
        if($resp >= 1){
            return $resp;
        }else{
            return 0;
        }
    }



}





?>