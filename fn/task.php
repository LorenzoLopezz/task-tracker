<?php 
	session_start();

	class Tasks{

		public $id,$titulo,$detalles,$tipo,$etiqueta,$user_id,$referencia,$prioridad,$grupo,$subgrupo,$creacion,$f_limite,$h_limite,$ult_upd,$bloqueo,$estado;

		public function __construct()
		{
			//code
		}

		public function addTask($titulo,$detalles,$tipo,$etiqueta,$referencia,$prioridad,$grupo,$subgrupo,$creacion,$f_limite,$h_limite,$ult_upd)
		{
			$this->titulo = $titulo;
			$this->detalles = $detalles;
			$this->tipo = $tipo;
			$this->etiqueta = $etiqueta;
			$this->user_id = $_SESSION['id_user'];
			$this->referencia = $referencia;
			$this->prioridad = $prioridad;
			$this->grupo = $grupo;
			$this->subgrupo = $subgrupo;
			$this->creacion = $creacion;
			$this->f_limite = $f_limite;
			$this->h_limite = $h_limite;
			$this->ult_upd = $ult_upd;

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

			$conexion -> query("INSERT INTO tareas(task_id,titulo,contenido,tipo,etiquetas,user_id,referencia,prioridad,grupo,subgrupo,creacion,F_limite,H_limite,ult_actualizacion,bloqueo,estado) VALUES('$this->id','$this->titulo','$this->detalles','$this->tipo','$this->etiqueta','$this->user_id','$this->referencia','$this->prioridad','$this->grupo','$this->subgrupo','$this->creacion','$this->f_limite','$this->h_limite','$this->ult_upd','0','1')");

			if($this->referencia == "0" ){
				require_once 'notification.php';
				$notif = new Notification();
				$notif->addNotification($this->user_id,$this->id,$this->titulo,$this->creacion,$this->f_limite,$this->h_limite);
			}
		}

		public function editTask($id,$titulo,$detalles,$tipo,$etiqueta,$prioridad,$f_limite,$h_limite,$ult_upd)
		{
			$this->id = $id;
			$this->titulo = $titulo;
			$this->detalles = $detalles;
			$this->tipo = $tipo;
			$this->etiqueta = $etiqueta;
			$this->prioridad = $prioridad;
			$this->f_limite = $f_limite;
			$this->h_limite = $h_limite;
			$this->ult_upd = $ult_upd;

			$conexion = new sqlite3('../db/information.db');

			$conexion -> query("UPDATE tareas SET titulo='$this->titulo',contenido='$this->detalles',tipo='$this->tipo',etiquetas='$this->etiqueta',prioridad='$this->prioridad', F_limite='$this->f_limite',H_limite='$this->h_limite',ult_actualizacion='$this->ult_upd' WHERE task_id='$this->id'");
			
			// $notif->addNotification($this->user_id,$this->detalles,$this->f_limite,$this->h_limite);
		}
	
		public function deleteTask($id){
			$this->id = $id;
			$conexion = new sqlite3('../db/information.db');
			$conexion -> query("DELETE FROM tareas WHERE task_id='$this->id' OR referencia='$this->id'");
			$conexion -> query("DELETE FROM notifications WHERE id_task='$this->id'");
		}

		public function getDataTask($id){
			$this->id = $id;
			$conexion = new sqlite3('../db/information.db');
			$data = $conexion-> query("SELECT * FROM tareas WHERE task_id='$this->id'");
			$data = $data -> fetchArray();
			return $data;
		}

		public function setState($status,$ident){
			$this->estado = $status;
			$this->id = $ident;
			$conexion = new sqlite3('../db/information.db');

			$conexion -> query("UPDATE tareas SET estado='$this->estado' WHERE task_id='$this->id'");
				return true;
		}

		public function countTask(){
			$conexion = new sqlite3('../db/information.db');

			$cons = $conexion -> query("SELECT * FROM tareas WHERE estado='1'");
			$i = 0;
			while($cont = $cons -> fetchArray()){
				$i = $i+1;
			}

			return $i;
		}
	}

?>