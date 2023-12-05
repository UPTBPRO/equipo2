

<?php
include 'db.php';
class User extends DB{
    //estas variables abajo parece que son
    //para asignar el nombre y el username
    // del usuario conseguido en la base de datos
    private $nombre;
    private $username;
	//esta pagina es llamada por index y ahi
	//esta la variable $user
    public function userExists($user, $pass){
        
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user AND password = :pass');
        $query->execute(['user' => $user, 'pass' => $pass]);
        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }
    
    public function superExists($user, $pass){
        
        $query = $this->connect()->prepare('SELECT * FROM supervisores WHERE username = :user AND password = :pass');
        $query->execute(['user' => $user, 'pass' => $pass]);
        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }
	//en esta funcion el foreach se encarga de averiguar el nombre de usuario
    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user');
        $query->execute(['user' => $user]);
        
        foreach ($query as $currentUser) {
            $this->nombre = $currentUser['nombre'];
            $this->username = $currentUser['username'];
            $this->tipouser = $currentUser['tipousuario'];
            $this->password = $currentUser['password'];
        }
    }
	//esta es una funcion para obtener el nombre
    public function getNombre(){
        return $this->nombre;
    }
    
    public function getUsername(){
        return $this->username;
    }
    public function getTipouser(){
        return $this->tipouser;
    }
    public function getPassword(){
        return $this->password;
    }
    //en esta funcion el foreach se encarga de averiguar el nombre de usuario
    //aqui se verifica el nombre de usuario con que inicio
    /*public function getUserPass($getuser, $getpass){
        $query = $this->connect()->prepare('SELECT * FROM usuarioactual WHERE username = :user');
        $query->execute(['user' => $user]);
        
        foreach ($query as $currentUser) {
            $this->nombre = $currentUser['nombre'];
            $this->username = $currentUser['username'];
            $this->tipouser = $currentUser['tipousuario'];
            $this->password = $currentUser['password'];
        }
    }*/
    
    
}
?>
