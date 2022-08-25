<div class="information-alert-hidden" id="more-modal">
    <div class="modal-box" id="more-box">
        <div style="padding:20px; border-radius:10px;">
            <div class="row" id="details_task">
            </div>
            <div class="row">
                <div class="col-xs-12 parrafo">
                    <p class="subtitulo"><b>SUBTAREAS</b></p>
                    <div id="contenedor_subtareas" style="max-height:200px;overflow-x:hidden;overflow-y:scroll;"></div>
                </div>
                <div class="col-xs-12" style="margin-top:30px;">
                <div class="row middle-xs">
                        <div class="col-xs-12 col-md-6">
                            <button class="marginNone parrafo" style="background: #808080;border: none;padding: 4px 20px;border-radius: 10px;margin-top: 5px; color: white;">Personal</button>
                        </div>
                        <div class="col-xs-6 col-md-3 center-xs">
                        <?php if($permisions == "w,r"): ?>
                            <button class="btn" style="margin:10px 0px;width:100%; padding: 8px 15px;background: #1261A0;color:white;border-radius:10px;box-shadow:0px">Editar</button>
                        <?php endif; ?>
                        </div>                        
                        <div class="col-xs-6 col-md-3 center-xs">
                            <button class="btn" style="margin:10px 0px;width:100%; padding: 8px 15px;background: #12A054;color:white;border-radius:10px;box-shadow:0px" onclick="showModal('more');">Ok</button>
                        </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>