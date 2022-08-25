<?php
date_default_timezone_set('America/El_Salvador');
$ahora = Date('Y-m-d');
$id_user = $_SESSION['id_user'];

$sql0 = $conexion -> query("SELECT COUNT(task_id) total FROM tareas WHERE user_id='$id_user' AND estado=1 AND referencia=0");
$sql_ = $sql0 -> fetchArray();
$sql_ = $sql_['total'];

$sql = $conexion -> query("SELECT * FROM tareas WHERE user_id='$id_user' AND estado=1 AND referencia=0");
$sql2 = $conexion -> query("SELECT * FROM tareas WHERE user_id='$id_user' AND estado=1 AND referencia=0");

?>

<?php if($sql_ > 0){ ?>

<div class="row content-wraper">
    <div class="col-xs-12">
        <h2 class="titulo celeste">Por caducar</h2>
    </div>
<?php 
while($row = $sql -> fetchArray()){
$txt = $row['F_limite']." ".$row['H_limite'];
$fecha = substr($txt,0,10);

if( $fecha == $ahora || $fecha == "" ){
    if($txt == "  :00"){$txt="--";};
$content = $row['contenido'];
$p=$row['prioridad'];
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

    <div class="col-xs-12 col-sm-4 col-md-3">
        <div class="box_task">
            <div class="row space">
                <div class="col-xs-9">
                    <h2 class="marginNone subtitulo"><div class="<?php echo $prioridad; ?>"></div> <?php echo substr($row['titulo'],0,14); $l = strlen($row['titulo']); if($l>14){echo '...';} ?></h2>
                </div>
                <div class="col-xs-3 end-xs" onmouseleave="see_more_options('<?php echo $row['task_id']; ?>','c');">
                    <button class="invisible-btn" id="about-task-show" style="margin-top:6px;" onclick="see_more_options('<?php echo $row['task_id']; ?>','a');">
                        <i class="material-icons">expand_more</i>
                    </button>
                    <div class="more-task-btn-hidden" id="more-options-task-<?php echo $row['task_id']; ?>">
                        <button style="width:100%;color:white;margin-bottom:5px;" class="invisible-btn" onclick="options('delete','<?php echo $row['task_id'] ?>','principal')">Eliminar</button>
                        <button style="width:100%;color:white;margin-bottom:5px;" class="invisible-btn" onclick="options('edit','<?php echo $row['task_id'] ?>')">Editar</button>
                    </div>
                </div>
            </div>
            <h4 class="marginNone space titulo red"><?php echo $txt; ?> <i class="material-icons" style="font-size:1rem;">access_alarm</i></h4>
            <p class="marginNone space parrafo space-subtask" onclick="showModal('more','','<?php echo $row['task_id']; ?>')"><?php 
                $len = strlen($content);
                if ($len > 35) {
                    echo substr($content,0,35)."..."; 
                } else {
                    echo $content; 
                }
            ?></p>
            <h4 class="marginNone space titulo">Subtareas <button class="invisible-btn add-btn" onclick="showModal('add','<?php echo $row['task_id']; ?>');">+</button></h4>
            <div class="row space-subtask" onclick="showModal('more','','<?php echo $row['task_id']; ?>')">
                <?php
                    $ref = $row['task_id'];
                    $c = $conexion -> query("SELECT COUNT(task_id) total FROM tareas WHERE referencia='$ref' AND estado=1");
                    $cc = $c -> fetchArray(); $ccc = $cc['total'];
                    if($ccc > 0) {
                        $cons = $conexion -> query("SELECT * FROM tareas WHERE referencia='$ref' AND estado=1");
                        $num = 1;
                        while($list = $cons -> fetchArray()){
                ?>
                    <div class="col-xs-2 col-md-2 center-xs">
                        <div class="subtasks-box">
                            <button class="invisible-btn" title="<?php echo $list['titulo']; ?>">
                                <?php echo '<p class="marginNone">'.$num.'</p>';$num = $num+1; ?>
                            </button>
                        </div>
                    </div>
                <?php
                        };
                    } else {
                        echo '<p class="parrafo marginNone" style="margin:10px 10px;color:#A2A2A2;">Sin subtareas...</p>';
                    }
                ?> 
                
            </div>
            <div class="row space middle-xs" style="margin-top: 20px;">
                <div class="col-xs-8 col-md-8">
                    <button class="marginNone parrafo" style="background: #DCDCDC;border: 1px solid #A2A2A2;padding: 4px 10px;border-radius: 5px;margin-top: 5px; color: #A2A2A2;"><?php echo $row['etiquetas']; ?></button>
                </div>
                <div class="col-xs-2 col-md-2 end-xs">
                    <button class="invisible-btn" style="margin-top:5px;" onclick="setTaskState('done','<?php echo $row['task_id']; ?>');"><i class="material-icons">done</i></button>
                </div>
                <div class="col-xs-2 col-md-2 end-xs">
                    <button class="invisible-btn disable-btn" style="margin-top:5px;"><i class="material-icons">share</i></button>
                </div>
            </div>
        </div>
    </div>
<?php
};
};
?>
</div>

<div class="row content-wraper">
    <div class="col-xs-12">
        <h2 class="titulo celeste">Próximas tareas</h2>
    </div>
<?php
while( $resp = $sql2 -> fetchArray() ){
$txt = $resp['F_limite']." ".$resp['H_limite'];
$fecha = substr($txt,0,10);

if( $fecha != $ahora || $fecha == "" ){
    if($txt == "  :00"){$txt="--";};
    $content = $resp['contenido'];
    $p=$resp['prioridad'];
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
    <div class="col-xs-12 col-sm-4 col-md-3">
        <div class="box_task">
            <div class="row space">
                <div class="col-xs-10">
                    <h2 class="marginNone subtitulo"><div class="<?php echo $prioridad; ?>"></div> <?php echo substr($resp['titulo'],0,16); $l = strlen($resp['titulo']); if($l>16){echo '...';} ?></h2>
                </div>
                <div class="col-xs-2 end-xs" onmouseleave="see_more_options('<?php echo $resp['task_id']; ?>','c');">
                    <button class="invisible-btn" id="about-task-show" style="margin-top:6px;" onclick="see_more_options('<?php echo $resp['task_id']; ?>','a');">
                        <i class="material-icons">expand_more</i>
                    </button>
                    <div class="more-task-btn-hidden" id="more-options-task-<?php echo $resp['task_id']; ?>">
                        <button style="width:100%;color:white;margin-bottom:5px;" class="invisible-btn" onclick="options('delete','<?php echo $resp['task_id'] ?>','principal')">Eliminar</button>
                        <button style="width:100%;color:white;margin-bottom:5px;" class="invisible-btn" onclick="options('edit','<?php echo $resp['task_id'] ?>')">Editar</button>
                    </div>
                </div>
            </div>
            <h4 class="marginNone space titulo red"><?php echo $txt;?> <i class="material-icons" style="font-size:1rem;">access_alarm</i></h4>
            <p class="marginNone space parrafo space-subtask" onclick="showModal('more','','<?php echo $resp['task_id']; ?>')"><?php 
                $len = strlen($content);
                if ($len > 35) {
                    echo substr($content,0,35)."..."; 
                } else {
                    echo $content; 
                }
            ?></p>
            <h4 class="marginNone space titulo">Subtareas <button class="invisible-btn add-btn" onclick="showModal('add','<?php echo $resp['task_id']; ?>');">+</button></h4>
            <div class="row space-subtask" onclick="showModal('more','','<?php echo $resp['task_id']; ?>')">
                <?php
                    $ref = $resp['task_id'];
                    $c = $conexion -> query("SELECT COUNT(task_id) total FROM tareas WHERE referencia='$ref' AND estado=1");
                    $cc = $c -> fetchArray(); $ccc = $cc['total'];
                    if($ccc > 0) {
                        $cons = $conexion -> query("SELECT * FROM tareas WHERE referencia='$ref' AND estado=1");
                        $num = 1;
                        while($list = $cons -> fetchArray()){
                ?>
                    <div class="col-xs-2 col-md-2 center-xs">
                        <div class="subtasks-box">
                            <button class="invisible-btn" title="<?php echo $list['titulo']; ?>">
                                <?php echo '<p class="marginNone">'.$num.'</p>';$num = $num+1; ?>
                            </button>
                        </div>
                    </div>
                <?php
                        };
                    } else {
                        echo '<p class="parrafo marginNone" style="margin:10px 10px;color:#A2A2A2;">Sin subtareas...</p>';
                    }
                ?> 
                
            </div>
            <div class="row space middle-xs" style="margin-top: 20px;">
                <div class="col-xs-8 col-md-8">
                    <button class="marginNone parrafo" style="background: #DCDCDC;border: 1px solid #A2A2A2;padding: 4px 10px;border-radius: 5px;margin-top: 5px; color: #A2A2A2;"><?php echo $resp['etiquetas']; ?></button>
                </div>
                <div class="col-xs-2 col-md-2 end-xs">
                    <button class="invisible-btn" style="margin-top:5px;" onclick="setTaskState('done','<?php echo $resp['task_id']; ?>');"><i class="material-icons">done</i></button>
                </div>
                <div class="col-xs-2 col-md-2 end-xs">
                    <button class="invisible-btn disable-btn" style="margin-top:5px;"><i class="material-icons">share</i></button>
                </div>
            </div>
        </div>
    </div>
<?php
};
};
?>
</div>
<?php } else { ?>

<div class="row content-wraper">
    <div class="col-xs-12">
        <h3 class="titulo" style="color:#606F7B;">Aún no tienes niguna tarea... <button class="btn accept-btn white" style="width:60px;height:60px;" onclick="showModal('add');"><i class="material-icons">add</i></button></h3>
    </div>
</div>

<?php }; ?>