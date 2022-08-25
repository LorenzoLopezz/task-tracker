<?php

    $titulo = "Iniciar Sesión - Tasks";
    include 'template/head.php';
?>

<div class="container-fluid" id="nav" style="position: fixed;width: 100%;">
    <div class="row">
        <div class="col-xs-12 center-xs secondary_nav" style="margin-bottom: 0px;background: rgba(0,0,0,0.4);">
            <h1 class="icon_text marginNone white" style="text-shadow: none;">TASKS</h1>
        </div>
    </div>
</div>


<?php if( empty($_GET['type']) || $_GET['type'] == "login" ): ?>
<div class="container-fluid form_login" id="formulario">
    <div class="row center-xs" style="padding: 60px 0px;color: #838383;padding-top: 130px;">
        <div class="col-xs-10 col-md-4 box_form">
            <form action="fn/handler.php" method="POST">
                <div class="row center-xs">
                    <div class="col-xs-12 space" style="padding-left: 30px;margin-bottom: 20px;">
                        <h3 class="titulo start-xs">INICIAR SESIÓN</h3>
                    </div>
                    <div class="col-xs-12 space" style="margin-bottom: 20px;">
                        <input name="correo_login" id="correo_login" type="text" class="input_material" placeholder="Usuario o Correo" style="width: 90%;font-size: 1rem;">
                    </div>
                    <div class="col-xs-12 space" style="margin-bottom: 20px;">
                        <input name="password_login" id="password_login" type="password" class="input_material" placeholder="Contraseña" style="width: 90%;font-size: 1rem;">
                    </div>
                    <div class="col-xs-12" style="margin: 20px auto;">
                        <a href="" class="subtitulo" style="color: #838383;">OLVIDE MÍ CONTRASEÑA</a>
                    </div>
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-6 paddingNone">
                                <a href="?type=register"><button class="btn_login btn" type="button">REGISTRO</button></a>
                            </div>
                            <div class="col-xs-6 paddingNone">
                                <button class="white btn btn_login bg_secondary" type="submit">ENTRAR</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php endif; if( !empty($_GET['type']) && $_GET['type'] == "register" ): ?>
<div class="container-fluid form_login" id="formulario">
    <div class="row center-xs" style="padding: 60px 0px;color: #838383;padding-top: 130px;">
        <div class="col-xs-10 col-md-4 box_form">
            <form action="fn/handler.php" method="POST">
                <div class="row center-xs">
                    <div class="col-xs-12 space" style="padding-left: 30px;margin-bottom: 20px;">
                        <h3 class="titulo start-xs">REGISTRARSE</h3>
                    </div>
                    <div class="col-xs-12 space" style="margin-bottom: 20px;">
                        <input type="text" class="input_material input-login" placeholder="Nombre" name="nombre" id="nombre">
                    </div>
                    <div class="col-xs-12 space" style="margin-bottom: 20px;">
                        <input type="text" class="input_material input-login" placeholder="Apellido" name="apellido" id="apellido">
                    </div>
                    <div class="col-xs-12 space" style="margin-bottom: 20px;">
                        <input type="text" class="input_material input-login" placeholder="Usuario" name="usuario" id="usuario" onchange="checkUser();">
                    </div>
                     <div class="col-xs-12 space" style="margin-bottom: 20px;">
                        <label for="nacimiento" class="parrafo" style="font-size: 0.8rem;width: 30%;">Fecha de Nacimiento</label>
                        <input type="date" class="input_material" name="nacimiento" style="width: 60%;font-size: 1rem;">
                    </div>
                    <div class="col-xs-12 space" style="margin-bottom: 20px;">
                        <input type="email" class="input_material input-login" placeholder="Correo" name="correo">
                    </div>
                    <div class="col-xs-12 space" style="margin-bottom: 20px;">
                        <input type="password" class="input_material input-login" placeholder="Contraseña" name="password">
                    </div>
                    <div class="col-xs-12 space" style="margin-bottom: 20px;">
                        <input type="password" class="input_material input-login" placeholder="Repite contraseña" name="rpassword">
                    </div>
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-6 paddingNone">
                                <a href="?type=login"><button class="btn btn_login" type="button">ENTRAR</button></a>
                            </div>
                            <div class="col-xs-6 paddingNone">
                                <button class="white btn btn_login bg_secondary" type="submit">REGISTRARSE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>

<script src="js/main.js"></script>
<?php
    include 'template/end.php';
?>