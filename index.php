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
        require_once 'fn/notification.php';
        $notif = new Notification();
        $list = $notif->showNotification();
    }

    $titulo = "Tasks";
    include 'template/head.php';
    $permisions = "w,r";
?>
<a name="add"></a>
<?php  include 'template/addTask.php'; include 'template/more_task.php'; ?>

<div style="position:absolute;z-index:-1000;opacity:0;margin-left:-1000px;" onload="countInitial()"><input type="text" id="countTask"></div>

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
                    <?php include 'template/task_handler.php'; ?>
                </div>

            </div>
        </div>
    </div>
</section>


<script src="js/main.js"></script>
<?php
    include 'template/end.php';
?>