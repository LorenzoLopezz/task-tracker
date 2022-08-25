<?php
$conexion = new sqlite3('../db/information.db');
$sql = $conexion -> query("SELECT * FROM tareas WHERE referencia='$id' AND estado='1'");
$n = 1;
while($resp = $sql -> fetchArray()){
?>
    <div class="row" style="border-bottom: 1px solid #C8C6C6;margin-bottom:10px;">
        <div class="col-xs-1 col-md-1 center-xs">
            <div style="width:25px;height:25px;border:1px solid #c2c2c2;border-radius:50%;">
                <p style="margin:5px 0px 0px 0px;"><?php echo $n;$n = $n+1; ?></p>
            </div>
        </div>
        <div class="col-xs-9 col-md-8">
            <p style="margin:7px 0px 10px 5px;"><?php echo $resp['titulo']; ?></p>
        </div>
        <div class="hidden-xs col-md-3">
            <div class="row center-xs">
                <button class="invisible-btn" style="margin-right:8%;"><i class="material-icons">date_range</i></button>
                <button class="invisible-btn" style="margin-right:8%;"><i class="material-icons">done</i></button>
                <button class="invisible-btn" onclick="options('delete','<?php echo $resp['task_id'] ?>','sub','<?php echo $resp['referencia'] ?>')"><i class="material-icons">delete</i></button>
            </div>
        </div>
        <div class="col-xs-2 hidden-md">
                <button class="invisible-btn"><i class="material-icons">more_horizontal</i></button>
        </div>
    </div>
<?php
};
?>