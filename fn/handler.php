<?php 

	date_default_timezone_set('America/El_Salvador');
	require_once 'user.php';
	require_once 'task.php';
	$class = new Tasks();
	
	if (!empty($_POST['rpassword'])) {
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$usuario = $_POST['usuario'];
		$correo = $_POST['correo'];
		$password = $_POST['password'];
		$rpassword = $_POST['rpassword'];
		$nacimiento = $_POST['nacimiento'];

		if($nombre == "" || $apellido == "" || $usuario == "" ||$email == "" || strpos($email,"@") === false){
			echo '<script> window.history.go(-1); </script>';
		} else {
			$user = new user();

			$user -> register_user($nombre,$apellido,$usuario,$correo,$password,$rpassword,$nacimiento);

			header('location:../');
		};
	}

	if(!empty($_POST['type']) && $_POST['type'] == "checkUser"){
		$resp = array();

		$check = new user();

		$result = $check -> checkUser($_POST['usuario']);
		
		$resp['result'] = $result;

		echo json_encode($resp);
	}

	if (!empty($_POST['correo_login']) && !empty($_POST['password_login'])) {
		$user = new user();
		$correo = $_POST['correo_login'];
		$pass = $_POST['password_login'];

		$login = $user->login_user($correo,$pass);

		if ($login == 'false') {
			header('location:../');
		} else {
			header('location:'.$_SERVER['HTTP_REFERER'].'?error=true');
		}
	}

	if (!empty($_POST['type']) && $_POST['type']=="newTask" ) {

		$titulo = $_POST['titulo_task'];
		$detalles = $_POST['detalles'];
		$tipo = $_POST['tipo'];
		$etiqueta = $_POST['etiqueta'];
		$referencia = $_POST['referencia'];
		$prioridad = $_POST['prioridad'];
		$grupo = $_POST['grupo'];
		$subgrupo = $_POST['subgrupo'];
		$creacion = date("Y-m-d H:i:s");
		$Flimite = $_POST['Flimite'];
		$Hlimite = substr($_POST['Hlimite'],0,8);
		$ult_upd = date("Y-m-d H:i:s");

		$n_task = new Tasks();
		
		$n_task->addTask($titulo,$detalles,$tipo,$etiqueta,$referencia,$prioridad,$grupo,$subgrupo,$creacion,$Flimite,$Hlimite,$ult_upd);
		$conexion = new sqlite3('../db/information.db');
		include '../template/task_handler.php';
	}

	if (!empty($_POST['type']) && $_POST['type']=="sendEdit" ) {

		$id = $_POST['id'];
		$titulo = $_POST['titulo_task'];
		$detalles = $_POST['detalles'];
		$tipo = $_POST['tipo'];
		$etiqueta = $_POST['etiqueta'];
		$prioridad = $_POST['prioridad'];
		$f_limite = $_POST['Flimite'];
		$h_limite = $_POST['Hlimite'];
		$ult_upd = date("Y-m-d H:i:s");

		$n_task = new Tasks();
		
		$n_task->editTask($id,$titulo,$detalles,$tipo,$etiqueta,$prioridad,$f_limite,$h_limite,$ult_upd);
		$conexion = new sqlite3('../db/information.db');
		include '../template/task_handler.php';
	}

	if(!empty($_POST['type']) && $_POST['type'] == "editTask"){
		$id = $_POST['id'];
		$data = $class->getDataTask($id);
		echo json_encode($data);
	}

	if(!empty($_POST['type']) && !empty($_POST['ref'])){
		$ref = $_POST['ref'];
		
		$class->deleteTask($ref);
		$conexion = new sqlite3('../db/information.db');
		$order = $_POST['order'];

		if($order === "principal"){
			include '../template/task_handler.php';
		};
		if($order === "sub"){
			$id = $_POST['depend'];
			include '../template/subtask_generator.php';
		}
	}

	if(!empty($_POST['setState'])){
		$state = $_POST['setState'];
		$id = $_POST['id'];
		if($state == "done"){
			$class->setState(0,$id);
		} else {
			$class->setState(1,$id);
		}
	}

//INICIA VISTA DE TAREA ------------------------
	if(!empty($_POST['details_task'])){
		$id = $_POST['ref'];
		$conexion = new sqlite3('../db/information.db');
		$select = $conexion -> query("SELECT * FROM tareas WHERE task_id='$id'");
		$r = $select -> fetchArray();
		$p=$r['prioridad'];
		$txt = $r['F_limite']." ".$r['H_limite'];
		if($txt === " :00"){$txt="--";};
		switch($p){
			case '0':
				$prioridad = "";
			break;
			case '1':
				$prioridad = "esperar";
			break;
			case '2':
				$prioridad = "importante";
			break;
			case '3':
				$prioridad = "urgente";
			break;
		}
?>

		<div class="col-xs-10 col-md-10 start-xs">
			<div class="<?php echo $prioridad; ?>"></div><h3 class="marginNone titulo" style="margin-top: 5px;"><b><?php echo $r['titulo']; ?></b></h3>
		</div>
		<div class="col-xs-2 col-md-2 col-md-2 end-xs">
			<button class="invisible-btn" onclick="showModal('more')"><i class="material-icons">close</i></button>
		</div>
		<div class="col-xs-12">
			<h4 class="marginNone space titulo red" style="font-size:0.8rem;"><?php echo $txt; ?></h4>
		</div>
		<div class="col-xs-12 parrafo" style="border-bottom:1px solid #006FFF;">
			<p><?php echo $r['contenido']; ?></p>
		</div>

<?php
	}
//TERMINA VISTA DE TAREA -------------------------

	if(!empty($_POST['subtask_generator']) && !empty($_POST['id'])){
		$id = $_POST['id'];
		include '../template/subtask_generator.php';
	}

	if(!empty($_POST['task_generator'])){
		$conexion = new sqlite3('../db/information.db');
		include '../template/task_handler.php';
	}

	if(!empty($_POST['list'])){
		$num = array();
		$num['result'] = $class -> countTask();
		echo json_encode($num);
	}

?>