<div class="modal fade" id="modal_eventos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="lbl_titulo_modal_eventos"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      <!-- hiddens -->
      <input type="hidden" id="id">
      <!-- End hiddens -->

        <div class="form-row mb-3">
            <div class="form-group col-12">
                <label for="">Titulo del evento:</label>
                <input type="text" id="Titulo" class="form-control" placeholder="Ingrese el titulo del evento...">
            </div>
        </div>


        <div class="form-row mb-3">
            <div class="form-group col-md-6 mb-3">
                <label for="fechaInicio">Fecha de inicio:</label>
                <div class="input-group" data-autoclose="true">
                    <input id="fechaInicio" type="date" class="form-control">
                </div>
            </div>

            <div class="form-group col-md-6" id="tituloHoraInicio">
                <label for="horaInicio">Hora de inicio:</label>
                <div class="input-group clockpicker" data-autoclose="true">
                    <input type="text" id="horaInicio" class="form-control" autocomplete="off">
                </div>
            </div>

        </div>

        <div class="form-row mb-3">
            <div class="form-group col-md-6 mb-3">
                <label for="fechaFin">Fecha de fin:</label>
                <div class="input-group" data-autoclose="true">
                    <input id="fechaFin" type="date" class="form-control">
                </div>
            </div>

            <div class="form-group col-md-6" id="tituloHoraFin">
                <label for="horaFin">Hora de fin:</label>
                <div class="input-group clockpicker" data-autoclose="true">
                    <input type="text" id="horaFin" class="form-control" autocomplete="off">
                </div>
            </div>

        </div>

        <div class="form-row mb-3">
            <label for="">Descripcion:</label>
            <textarea id="Descripcion" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-row mb-3">
            <label for="">Color de fondo:</label>
            <input id="ColorFondo" class="form-control" type="color" value="#3788d8">
        </div>

        <div class="form-row mb-3">
            <label for="">Color de texto:</label>
            <input id="ColorTexto" class="form-control" type="color" value="#ffffff">
        </div>


      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" id="btnAgregarEvento" class="btn btn-success" onclick="agregarEvento()">Agregar</button>
        <button type="button" id="btnModificarEvento" class="btn btn-success" onclick="modificarEvento()">Modificar</button>
        <button type="button" id="btnBorrarEvento" class="btn btn-success" onclick="borrarEvento()">Borrar</button>
      </div>
    </div>
  </div>
</div>