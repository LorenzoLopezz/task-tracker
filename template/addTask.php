<div class="information-alert-hidden" id="add-modal">
    <div class="modal-box" id="modal-box">
        <div class="row">
            <div class="col-xs-9 col-md-10 start-xs">
                <h3 class="marginNone titulo" style="margin-top: 5px;" id="titulo_modal">AGREGAR TAREA</h3>
            </div>
            <div class="col-xs-3 col-md-2 col-md-2 end-xs">
                <button class="invisible-btn" onclick="showModal('add')"><i class="material-icons">close</i></button>
            </div>
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12 col-md-12 space">
                        <input class="input_material_circle space titulo" name="titulo" id="titulo" type="text" placeholder="Titulo" style="font-weight: bold;">
                    </div>
                    <div class="col-xs-12 col-md-12 space">
                        <textarea class="input_material_circle parrafo" name="detalles" id="detalles" cols="" rows="3" placeholder="Detalles..."></textarea>
                    </div>
                    <div class="col-xs-12 col-md-12 space">
                        <select class="input_material_circle space titulo" name="etiqueta" id="etiqueta" style="width:100%;">
                            <option value="Bandeja">Etiqueta</option>
                            <option value="Personal">Personal</option>
                            <option value="Importante">Importante</option>
                            <option value="Universidad">Universidad</option>
                            <option value="Trabajo">Trabajo</option>
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-12 space">
                        <select class="input_material_circle space titulo" name="prioridad" id="prioridad" style="width:100%;">
                            <option value="0">Prioridad</option>
                            <option value="3">Urgente</option>
                            <option value="2">Importante</option>
                            <option value="1">Puede esperar</option>
                        </select>
                    </div>
                    <div class="col-xs-12 parrafo space">
                        <h4 class="marginNone">LÍMITE </h4>
                        <p id="limit"></p>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <input class="input_material_circle space titulo fullSize" name="fechaLim" id="fechaLim" type="date" style="width:95%;">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <input class="input_material_circle space titulo fullSize" name="horaLim" id="horaLim" type="time" style="width:95%;">
                    </div>
                    <div class="col-xs-6 center-xs">
                        <button class="btn white accept-btn" id="btn-toAddTask" onClick="sendTask();" data_ref="">Agregar</button>
                    </div>
                    <div class="col-xs-6 center-xs">
                        <button class="btn white cancel-btn" onclick="clean_Modal();showModal('add');">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>