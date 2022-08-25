function consulta(tipo,url,data,done)
{

    if(window.XMLHttpRequest){
        connection = new XMLHttpRequest();
    } else if(window.ActiveXObject){
        connection = new ActiveXObject("Microsoft.XMLHTTP");
    }

    connection.onreadystatechange = done;

    connection.open(tipo, url);
    connection.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    connection.send(data);
}
  
function getHeight(){
    return document.body.scrollHeight;
}

function getWidth(){
    return document.documentElement.clientWidth;
}

function getScreenHeight(){
    return screen.height + 100;
}

if (document.getElementById('principal_nav')) {
    resizing();
}

if(document.getElementById('formulario')){
    document.getElementById('formulario').setAttribute('style','background-size:cover;height:'+getScreenHeight()+'px;');
};

function checkUser(){
    var user = document.getElementById('usuario').value;

    consulta('POST','fn/handler.php','type=checkUser&usuario='+user,request);
    
    function request(){
        if(connection.readyState == 4){
            var resp = JSON.parse(connection.responseText);
            if (resp.result === true) {
                document.getElementById('usuario').setAttribute('class','border-color:rgba(0,255,0,1);background-color:rgba(0,255,0,0.2);');
            } else if(resp.result === "short") {
                    document.getElementById('usuario').setAttribute('class','border-color:rgba(240,255,0,1);background-color:rgba(240,255,0,0.2);');
            } else {
                document.getElementById('usuario').setAttribute('class','border-color:rgba(255,0,0,1);background-color:rgba(255,0,0,0.2);');
            }
        }
    }
}

function floatbn (){
    var btn = document.getElementById('float_btn');
    var h = window.innerHeight;
    var w = window.innerWidth;

    var mTop    = h - 80;
    var mLeft   = w - 90;

    btn.setAttribute('style','margin-top:'+mTop+'px; margin-left:'+mLeft+'px;');
}

function resizing(){
    // document.getElementById('principal_nav').setAttribute('style','height:'+document.documentElement.clientHeight+'px');
    document.getElementById('add-modal').setAttribute('style','width:'+getWidth()+'px;height:'+getHeight()+'px;');
    document.getElementById('more-modal').setAttribute('style','width:'+getWidth()+'px;height:'+getHeight()+'px;');
    
    var width = getWidth();var height = getHeight();

    if(width <= 740){ document.getElementById('modal-box').setAttribute('style','width: 86%;margin: 5% 7% 0% 7%;');
    } else { document.getElementById('modal-box').setAttribute('style','');
    }
    if(width <= 740){ document.getElementById('more-box').setAttribute('style','width: 86%;margin: 5% 7% 0% 7%;');
    } else { document.getElementById('more-box').setAttribute('style','');
    }

    floatbn();
}

function sendTask(){
    var titulo    = document.getElementById('titulo').value;
    var etiqueta    = document.getElementById('etiqueta').value;
    var prioridad    = document.getElementById('prioridad').value;
    var detalles  = document.getElementById('detalles').value;
    var fechaL     = document.getElementById('fechaLim').value;
    var horaL      = document.getElementById('horaLim').value;
    var ref        = document.getElementById('btn-toAddTask');
    ref = ref.getAttribute('data_ref');

    consulta('POST','fn/handler.php',"type=newTask&titulo_task="+titulo+"&etiqueta="+etiqueta+"&detalles="+detalles+"&tipo=tarea&referencia="+ref+"&prioridad="+prioridad+"&grupo=0&subgrupo=0&Flimite="+fechaL+"&Hlimite="+horaL+":00",request);

    function request(){
        if(connection.readyState === 4){
            var resp = connection.responseText;
            if (resp){
                clean_Modal();
                showModal("add");
                document.getElementById('bigbox_tasks').innerHTML = resp;
            } else {
                var req = JSON.parse(connection.responseText);
                alert(req.error);
            }
        }
    }
}

function sendEdit(){
    var titulo    = document.getElementById('titulo').value;
    var etiqueta    = document.getElementById('etiqueta').value;
    var prioridad    = document.getElementById('prioridad').value;
    var detalles  = document.getElementById('detalles').value;
    var fechaL     = document.getElementById('fechaLim').value;
    var horaL      = document.getElementById('horaLim').value;
    var ref        = document.getElementById('btn-toAddTask');
    ref = ref.getAttribute('data_ref');

    consulta('POST','fn/handler.php',"type=sendEdit&id="+ref+"&titulo_task="+titulo+"&etiqueta="+etiqueta+"&detalles="+detalles+"&tipo=tarea&referencia="+ref+"&prioridad="+prioridad+"&Flimite="+fechaL+"&Hlimite="+horaL+":00",request);

    function request(){
        if(connection.readyState === 4){
            var resp = connection.responseText;
            if (resp){
                clean_Modal();
                showModal("add");
                document.getElementById('bigbox_tasks').innerHTML = resp;
            } else {
                var req = JSON.parse(connection.responseText);
                alert(req.error);
            }
        }
    }
}

function see_more_options(id,type){
    var box = document.getElementById('more-options-task-'+id);

    if(type == 'c'){
            box.className = "more-task-btn-hidden";
    } else {
        if(box.className!="more-task-btn-hidden"){
                box.className="more-task-btn-hidden";
        } else {
                box.className="more-task-btn";            
        }
    }
}

function menuDropDown(id,type){
    var box = document.getElementById(id);
    if(id == "notifications-xs" || id == "notifications-md" && type == "a"){
        if(box.className != "notification-box-hidden"){
            box.className = "notification-box-hidden";
        } else {
            box.className = "notification-box";
        }
    }
    if(id == "notifications-xs" || id == "notifications-md" && type == "c"){
            box.className = "notification-box-hidden";
    }
    
    if(id == "settings-xs" || id == "settings-md"){
        if(box.className != "more-task-btn-hidden"){
            box.className = "more-task-btn-hidden";
        } else {
            box.className = "more-task-btn";
        }
    }
    if(id == "settings"){
            document.getElementById('settings-md').className = "more-task-btn-hidden";
            document.getElementById('settings-xs').className = "more-task-btn-hidden";
    }
}

function options(type,ref,order,depend){
    switch(type){
        case "delete":
            consulta('POST','fn/handler.php','type=deleteTask&ref='+ref+'&order='+order+'&depend='+depend,end);

            function end(){
                if(connection.readyState === 4){
                    resp = connection.responseText;
                    if(order === "principal"){
                        document.getElementById('bigbox_tasks').innerHTML = resp;
                    } else if(order === "sub"){
                        document.getElementById('contenedor_subtareas').innerHTML = resp;
                        consulta('POST','fn/handler.php','task_generator=true',set);
                        function set(){
                            if(connection.readyState === 4){
                                r = connection.responseText;
                                document.getElementById('bigbox_tasks').innerHTML = r;
                            }
                        }
                    }
                }
            }
        break;
        case "edit":
                var titulo    = document.getElementById('titulo');
                var etiqueta    = document.getElementById('etiqueta');
                var prioridad    = document.getElementById('prioridad');
                var detalles  = document.getElementById('detalles');
                var fechaL     = document.getElementById('fechaLim');
                var horaL     = document.getElementById('horaLim');
                var btn        = document.getElementById('btn-toAddTask');
                document.getElementById('titulo_modal').innerHTML = "EDITAR TAREA";

                consulta('POST',"fn/handler.php","type=editTask&id="+ref,eco);

                function eco(){
                    if(connection.readyState === 4){
                        var resp = JSON.parse(connection.responseText);
                        titulo.value = resp.titulo;
                        etiqueta.value = resp.etiquetas;
                        prioridad.value = resp.prioridad;
                        detalles.value = resp.contenido;
                        fechaL.value = resp.F_limite;
                        horaL.value = resp.H_limite;

                        btn.setAttribute('onclick','sendEdit()');
                        btn.innerHTML = "Terminar";

                        showModal('add',ref);
                    }
                }
        break;
        case "bin":
            consulta('POST','fn/handler.php','type=deleteTask&ref='+ref+'&order='+order,bin);
            function bin(){
                if(connection.readyState === 4){
                    resp = connection.responseText;
                    document.getElementById(ref).setAttribute('style','display:none');
                }
            }
        break;
        case "recovery":
            consulta('POST','fn/handler.php','type=deleteTask&ref='+ref+'&order='+order,bin);
            function bin(){
                if(connection.readyState === 4){
                    resp = connection.responseText;
                    document.getElementById(ref).setAttribute('style','display:none');
                }
            }
        break;
    }
}

//Agregar tarea modal
function showModal(modal_id,ref,id){

    var mo = modal_id;

    if(modal_id=="add"){
        if(ref){ document.getElementById('btn-toAddTask').setAttribute('data_ref',ref);
        } else { document.getElementById('btn-toAddTask').setAttribute('data_ref','0');
        }
    }

    if(modal_id=="more"){
        var contenedor = document.getElementById('contenedor_subtareas');
        document.getElementById('titulo_modal').innerHTML = "AGREGAR SUBTAREA";

        consulta('POST','fn/handler.php','ref='+id+'&details_task=true',re);
        function re(){
            if(connection.readyState === 4){
                respt=connection.responseText;
                document.getElementById('details_task').innerHTML = respt;
            }
        }

        setTimeout(function(){if(id){
            consulta('POST','fn/handler.php','id='+id+'&subtask_generator=true',result);
            function result(){
                if(connection.readyState === 4){
                    resp=connection.responseText;
                    contenedor.innerHTML = resp;
                }
            }
        } else { contenedor.innerHTML = ""; }},300);
    }

    if(document.getElementById(modal_id+"-modal")){
        var box = document.getElementById(modal_id+"-modal");
        if(box.className != "information-alert-hidden"){
            box.className = "information-alert-hidden";
        } else { box.className = "information-alert"; }
    };
}

function clean_Modal(){
        document.getElementById('titulo').value = "";
        document.getElementById('etiqueta').value = 0;
        document.getElementById('prioridad').value = 0;
        document.getElementById('detalles').value = "";
        document.getElementById('fechaLim').value = "";
        document.getElementById('horaLim').value = "";
        document.getElementById('titulo_modal').innerHTML = "AGREGAR TAREA";
        var btn = document.getElementById('btn-toAddTask');
        btn.setAttribute('data_ref','0');
        btn.setAttribute('onclick','sendTask();');
        btn.innerHTML = "Agregar";
}

function setTaskState(state,id){
    if(state == "done"){
        consulta('POST','fn/handler.php','setState='+state+'&id='+id,done);

        function done(){
            if(connection.readyState === 4){
                var resp = connection.responseText;
                consulta('POST','fn/handler.php','task_generator=true',set);
                function set(){
                    if(connection.readyState === 4){
                        r = connection.responseText;
                        document.getElementById('bigbox_tasks').innerHTML = r;
                    }
                }
            }
        }
    } else if(state == "undone"){
        consulta('POST','fn/handler.php','setState='+state+'&id='+id,undone);

        function undone(){
            if(connection.readyState === 4){
                document.getElementById(id).setAttribute('style','display:none');
            }
        }
    }
}

function notifications(idNotif,idTask){
    consulta('POST','fn/notification.php','idNotif='+idNotif+'&type=rev',ready);

    function ready(){
        if(connection.readyState === 4){
            document.getElementById('countNotif').className = "";
            document.getElementById('countNotif').innerHTML = "";
            showModal('more','',idTask);
        }
    }
}

function getTasks(){
    consulta('POST','fn/handler.php','task_generator=true',showTasks);

    function showTasks(){
        if(connection.readyState === 4){
            document.getElementById('bigbox_tasks').innerHTML = connection.responseText;
        }
    }
}

if(document.getElementById('countTask')){
    function countInitial(){
        consulta('POST','fn/handler.php','list=true',saveCount);
    
        function saveCount(){
            if(connection.readyState === 4){
                var resp = JSON.parse(connection.responseText);
                var rr = resp.result;
                document.getElementById('countTask').setAttribute('value',rr);
            }
        }
    }

    countInitial();

    function countTasks(){
        consulta('POST','fn/handler.php','list=true',re_count);
    
        function re_count(){
            if(connection.readyState === 4){
                var resp = JSON.parse(connection.responseText);
                var newCount = resp.result;
                var count = document.getElementById('countTask').value;
                if(newCount > count || newCount < count){
                    document.getElementById('countTask').setAttribute('value',newCount);
                    getTasks();
                }
            }
        }
        setTimeout(function(){countTasks()},2000);
    }
    
    setTimeout(function(){countTasks();},2000);
}