<?php 

	class user 
	{

		private $id,$nombre,$apellido,$usuario,$correo,$password,$nacimiento;
		private $rpassword;

		public function __construct()
		{
			// Código
		} 

		public function login_user($email,$pass){
			$this->correo = $email;
			$this->password = $pass;

			if ($this->password == "") {
				return false;
			} else {
				$conexion = new sqlite3('../db/information.db');
				$sql = $conexion->query("SELECT * FROM usuarios WHERE correo='$this->correo' OR usuario='$this->correo' AND password='$this->password'");
				$row = $sql -> FetchArray();
				if (!$row['usuario_id']) { 
					return false;					
				} else { 
					session_start();
					$_SESSION['id_user'] = $row['usuario_id'];
					$_SESSION['name'] = $row['nombre'];
					$_SESSION['lastname'] = $row['apellido'];
					
					return true;
				}
			}
		}

		public function register_user($nombre,$apellido,$usuario,$correo,$password,$rpassword,$nacimiento){
			//Codigo
			$this->nombre = $nombre; 
			$this->apellido = $apellido;
			$this->usuario = $usuario;
			$this->correo = $correo;
			$this->password = $password;
			$this->rpassword = $rpassword;
			$this->nacimiento = $nacimiento;

			function uniqidReal($lenght = 12) {
			    if (function_exists("random_bytes")) {
			        $bytes = random_bytes(ceil($lenght / 2));
			    } elseif (function_exists("openssl_random_pseudo_bytes")) {
			        $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
			    } else {
			        throw new Exception("no cryptographically secure random function available");
			    }
			    return substr(bin2hex($bytes), 0, $lenght);
			}
			$this->id = uniqidReal();
			$conexion = new sqlite3('../db/information.db');
			$conexion -> query("INSERT INTO usuarios(usuario_id,nombre,apellido,usuario,correo,password,nacimiento) VALUES('$this->id','$this->nombre','$this->apellido','$this->usuario','$this->correo','$this->password','$this->nacimiento')");

			header('location:../');
		}

		public function checkUser($user){
			if (strlen($user) > 6) {
				$conexion = new sqlite3('../db/information.db');
				$sql = $conexion -> query("SELECT * FROM usuarios WHERE usuario = '$user'");
				$row = $sql -> fetchArray();
				if (!$row['usuario_id']) {
					return true;
				} else {
					return false;
				};
			} else {
				return 'short';
			};
		}

	};

?>