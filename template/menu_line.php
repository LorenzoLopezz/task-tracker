<?php
    $hoy = date('Y-m-d');
    $cons = $conexion -> query("SELECT id_notification FROM notifications WHERE id_user='$id_user' AND F_limite='$hoy' AND estado='1'");
    $cont_notif = 0;
    while($n = $cons -> fetchArray()){
        $cont_notif = $cont_notif+1;
    }

    if($cont_notif > 0){
        $signal = "notif-on";
    } else {
        $signal = "";
        $cont_notif = "";
    }
?>
<div class="row end-md">
    <div class="col-xs-12 col-sm-12 col-md-12 start-xs">

        <div class="row middle-xs secondary_nav">
            <div class="col-xs-12 col-sm-7 col-md-7 center-xs start-sm start-md">
                <a href="./"><h1 class="icon_text marginNone">TASKS</h1></a>
            </div>
            <div class="col-xs-8 col-sm-3 col-md-3">
                <div class="row middle-xs">
                    <div class="col-xs-9">
                        <input class="input_material fullSize" type="text" placeholder="Buscar...">
                    </div>
                    <div class="col-xs-3">
                        <button class="invisible-btn"><i class="material-icons">search</i></button>
                    </div>
                </div>
            </div>

            <div class="col-md-1 center-md hidden-xs separator" onmouseleave="menuDropDown('notifications-md','c');">
                <button class="invisible-btn" onclick="menuDropDown('notifications-md','a');"><i class="material-icons">notifications</i><span id="countNotif" class="<?php echo $signal; ?>"><?php echo $cont_notif; ?></span></button>

                <div id="notifications-md" class="notification-box-hidden" style="width:30%;margin-left:-340px;">
<?php 
    require_once 'fn/notification.php';
    $notif = new Notification();
    $consult = $notif->showNotification();

    if($cont_notif > 0 ){
        while($notification = $consult -> fetchArray() ){
            $notifState = $notification['estado'];
            if($notifState == "0"){
                $alert = "";
            } else {
                $alert = "celeste";
            }
?>
                    <div class="notif-box">
                        <a href="#">
                            <button class="invisible-btn fullSize end-xs">
                                <div class="container-fluid">
                                    <div class="row <?php echo $alert; ?>" onclick="notifications('<?php echo $notification['id_notification']; ?>','<?php echo $notification['id_task']; ?>')">
                                        <div class="col-xs-3 start-xs">
                                            <?php echo $notification['F_limite']; ?>
                                        </div>
                                        <div class="col-xs-9" title="<?php echo $notification['content']; ?>">
                                            <?php echo substr($notification['content'],0,25); ?>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </a>
                    </div>
<?php   
        }; 
    } else {
?>
                    <div class="notif-box">
                        <a href="bin.php"><button class="invisible-btn fullSize end-xs">No hay notificaciones</button></a>
                    </div>
<?php
    };
?>
                </div>
            </div>

            <div class="col-xs-2 center-xs hidden-md separator" onmouseleave="menuDropDown('notifications-xs','c');">
                <button class="invisible-btn" onclick="menuDropDown('notifications-xs','a');"><i class="material-icons">notifications</i></button>
                <div id="notifications-xs" class="notification-box-hidden" style="width:90%;margin-left:-240px;">
<?php 
    if($cont_notif > 0 ){
        while($notification = $consult -> fetchArray()) {
            $notifState = $notification['estado'];
            if($notifState == "0"){
                $alert = "";
            } else {
                $alert = "celeste";
            }
?>
                    <div class="notif-box">
                        <a href="#">
                            <button class="invisible-btn fullSize end-xs">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xs-12 start-xs" title="<?php echo $notification['content']; ?>">
                                            <?php echo substr($notification['content'],0,25); ?>
                                        </div>
                                        <div class="col-xs-12">
                                            <?php echo substr($notification['f_limite']); ?>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </a>
                    </div>
<?php   
        }; 
    } else {
?>
                    <div class="notif-box">
                        <a href="bin.php"><button class="invisible-btn fullSize end-xs">No hay notificaciones</button></a>
                    </div>
<?php
    };
?>
                </div>

            </div>

            <div class="col-xs-2 col-sm-1 col-md-1 center-xs separator" onmouseleave="menuDropDown('settings','c');">
                <button class="invisible-btn hidden-xs" onclick="menuDropDown('settings-md','a');"><i class="material-icons">settings</i></button>
                <button class="invisible-btn hidden-md" onclick="menuDropDown('settings-xs','a');"><i class="material-icons">settings</i></button>

                <div id="settings-md" style="padding:10px 5px;text-align:right;" class="more-task-btn-hidden">
                    <div class="menu_opt"><button class="invisible-btn open_p_m fullSize end-xs">Perfil</button></div>
                    <div class="menu_opt">
                        <a href="bin.php"><button class="invisible-btn open_p_m fullSize end-xs">Tareas Finalizadas</button></a>
                    </div>
                    <div><a href="fn/logout.php"><button class="invisible-btn open_p_m fullSize end-xs">Cerrar Sesión</button></a></div>
                </div>

                <div id="settings-xs" style="padding:10px 5px;text-align:right;margin-left:-60px;" class="more-task-btn-hidden">
                    <div class="menu_opt"><button class="invisible-btn open_p_m fullSize end-xs">Perfil</button></div>
                    <div class="menu_opt">
                        <a href="bin.php"><button class="invisible-btn open_p_m fullSize end-xs">Tareas Finalizadas</button></a>
                    </div>
                    <div><a href="fn/logout.php"><button class="invisible-btn open_p_m fullSize end-xs">Cerrar Sesión</button></a></div>
                </div>
            </div>
        </div>