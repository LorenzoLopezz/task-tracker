<?php
    session_start();
    date_default_timezone_set('America/El_Salvador');
    if (!$_SESSION) {
        header('location:login.php');
    } else {
        $id_user = $_SESSION['id_user'];
        $name = $_SESSION['name'];
        $lastname = $_SESSION['lastname'];

        include 'fn/conexion.php';
        $sql2 = $conexion -> query("SELECT * FROM tareas WHERE user_id='$id_user' AND estado=0 AND referencia=0 ORDER BY creacion DESC");
    }

    include 'fn/conexion.php';
    $titulo = "Papelera - Tasks";
    include 'template/head.php';
    $permisions = "r";
    
?>
<a name="add"></a>
<?php  include 'template/addTask.php'; include 'template/more_task.php'; ?>

<div class="float-btn" id="float_btn">
    <a href="#add"><button class="center-xs white btn-float" onclick="showModal('add');">
        <i class="material-icons">add</i>
    </button></a>
</div>

<section id="wraper" style="min-height:800px;">
    <!-- <div class="principal_nav back-p_nav hidden-xs" id="principal_nav">
        <div class="container-fluid paddingNone hidden-sm">
            <div class="row end-xs">
                <div class="col-md-2">
                    <button class="invisible-btn open_p_m">
                        <i class="material-icons">menu</i>
                    </button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row center-xs">
                <div class="col-md-8" style="margin-top: 20px;">
                    <img src="img/default.png" alt="Perfil" width="100%">
                </div>
                <h3><?php echo $name." ".$lastname; ?></h3>
            </div>
            <div class="row center-xs">
                <div class="col-xs-12">
                    <button class="big-button big-button-active">
                            <div class="row middle-xs center-xs">
                                <div class="col-md-2" style="text-align:end;"><i class="material-icons">home</i></div>
                                <div class="col-md-3 paddingNone"><p class="margin0" style="text-align:start;">INICIO</p></div>
                            </div>
                    </button>
                    <button class="big-button">
                            <div class="row middle-xs center-xs">
                                <div class="col-md-2" style="text-align:end;"><i class="material-icons">hourglass_full</i></div>
                                <div class="col-md-3 paddingNone"><p class="margin0" style="text-align:start;">TIEMPO</p></div>
                            </div>
                    </button>
                    <button class="big-button">
                            <div class="row middle-xs center-xs">
                                <div class="col-md-2" style="text-align:end;"><i class="material-icons">notes</i></div>
                                <div class="col-md-3 paddingNone"><p class="margin0" style="text-align:start;">NOTAS</p></div>
                            </div>
                    </button>
                    <button class="big-button">
                            <div class="row middle-xs center-xs">
                                <div class="col-md-2" style="text-align:end;"><i class="material-icons">date_range</i></div>
                                <div class="col-md-5 paddingNone"><p class="margin0" style="text-align:start;">CALENDARIO</p></div>
                            </div>
                    </button>
                </div>
            </div>
        </div>
    </div> -->

    <div class="container-fluid">
        <?php include 'template/menu_line.php'; ?>
                <div id="bigbox_tasks">
                <div class="row content-wraper">
    <div class="col-xs-12">
            <div class="row middle-xs">
                <div class="col-xs-2 col-md-1">
                    <a href="index.php"><button class="invisible-btn" style="background:#e0e0e0;width:100%;border-radius:10px;"><i class="material-icons">arrow_back</i></button></a>
                </div>
                <div class="col-xs-10 col-md-11">
                    <h2 class="titulo celeste">Tareas terminadas</h2>
                </div>
            </div>
    </div>
    <?php
        while( $resp = $sql2 -> fetchArray() ){
        $txt = $resp['F_limite']." ".$resp['H_limite'];

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
        <div class="col-xs-12 col-md-4" id="<?php echo $resp['task_id']; ?>">
            <div class="box_task">
                <div class="row space">
                    <div class="col-xs-12">
                        <h2 class="marginNone subtitulo"><div class="<?php echo $prioridad; ?>"></div> <?php echo substr($resp['titulo'],0,14); $l = strlen($resp['titulo']); if($l>14){echo '...';} ?></h2>
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
                <h4 class="marginNone space titulo">Subtareas</h4>
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
                        <button class="invisible-btn" style="margin-top:5px;" onclick="setTaskState('undone','<?php echo $resp['task_id'] ?>')"><i class="material-icons">autorenew</i></button>
                    </div>
                    <div class="col-xs-2 col-md-2 end-xs">
                        <button class="invisible-btn" style="margin-top:5px;" onclick="options('bin','<?php echo $resp['task_id'] ?>')"><i class="material-icons">delete</i></button>
                    </div>
                </div>
            </div>
        </div>
    <?php
    };
    ?>
    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<script src="js/main.js"></script>
<?php
    include 'template/end.php';
?>