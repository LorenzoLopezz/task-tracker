<?php
    class Notification 
    {

        private $conexion, $id_notif, $id_user, $id_task, $content, $fecha, $f_limite, $h_limite, $estado;

        public function __construct(){
            $this->id_notif = "0000AAAA";
            $this->id_user = 'c';
            $this->id_task = "4444eeee";
            $this->content = "Notificación de prueba";
            $this->fecha = "2019-07-03 17:13:00";
            $this->f_limite = "2019-07-03";
            $this->h_limite = "17:13:00";
            $this->estado = "1";
        }

        public function showNotification(){
            include 'conexion.php';
            $hoy = date('Y-m-d');
            $cons = $conexion -> query("SELECT * FROM notifications WHERE id_user='$this->id_user' AND F_limite='$hoy' ORDER BY H_limite AND F_limite ASC");
            return $cons;
        }

        public function addNotification($id_user,$id_task,$content,$fecha,$f_limite,$h_limite){
            function uniqid_($lenght = 12) {
			    if (function_exists("random_bytes")) {
			        $bytes = random_bytes(ceil($lenght / 2));
			    } elseif (function_exists("openssl_random_pseudo_bytes")) {
			        $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
			    } else {
			        throw new Exception("no cryptographically secure random function available");
			    }
			    return substr(bin2hex($bytes), 0, $lenght);
            }
            $conexion = new sqlite3('../db/information.db');
            $this->id_notif = uniqid_();
            $this->id_user = $id_user;
            $this->id_task = $id_task;
            $this->content = $content;
            $this->fecha = $fecha;
            $this->f_limite = $f_limite;
            $this->h_limite = $h_limite;
            $this->estado = "1";

            $sql = $conexion -> query("INSERT INTO notifications(id_notification,id_user,id_task,content,fecha,f_limite,h_limite,estado) VALUES('$this->id_notif','$this->id_user','$this->id_task','$this->content','$this->fecha','$this->f_limite','$this->h_limite','$this->estado')");

            return true;
        }

        public function testAddNotification($id_user){
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
            include 'conexion.php';
            $this->id_notif = uniqidReal();
            $this->id_task = "4444eeee";
            $this->content = "Notificación de prueba";
            $this->fecha = "2019-07-03 17:13:00";
            $this->f_limite = "2019-07-03";
            $this->h_limite = "17:13:00";
            $this->estado = "1";

            $sql = $conexion -> query("INSERT INTO notifications(id_notification,id_user,content,fecha,f_limite,h_limite,estado) VALUES('$this->id_notif','$this->id_user','$this->content','$this->fecha','$this->f_limite','$this->h_limite','$this->estado')");

            return true;
        }

        public function setNotification($id,$state,$db){
            $this->id_notif = $id;
            $this->estado = $state;
            $conexion = new sqlite3($db);
            $conexion -> query("UPDATE notifications SET estado='$this->estado' WHERE id_notification='$this->id_notif'");
        }

        public function delNotification($id){
            $this->id_notif = $id;

            include 'conexion.php';
            $conexion -> query("DELETE FROM notifications WHERE id_notification='$this->id_notif'");
        }

    }

    if(!empty($_POST['type']) && $_POST['type'] == "rev"){
        $idNotif = $_POST['idNotif'];
        $notification = new Notification();
        $notification->setNotification($idNotif,'0','../db/information.db');
    }
?>