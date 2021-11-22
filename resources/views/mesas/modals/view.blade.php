
<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h4 class="modal-title" id="userCrudModal"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="modal-body">
            <div class="form-group row">
                <label for="name" class="col-sm-4 col-form-label">Nombre *:</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" id="name" placeholder="Nombre" value='{{$dataEdit->name}}'>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-6 col-form-label">Cantidad de Personas *:</label>
                <div class="col-sm-6">
                <input type="number"  min="0" class="form-control" id="cantidad_personas" placeholder="" value='{{$dataEdit->cantidad_personas}}'>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-4 col-form-label">Mesa Activa *:</label>
                <div class="col-sm-8">
                <input class="form-check-input" type="checkbox" value="" id="active" disabled {{$dataEdit->active?'checked':''}}>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-4 col-form-label">Numero de Orden*:</label>
                <div class="col-sm-8">
                <input type="number"  min="0" class="form-control" id="orden_active" disabled placeholder="" value='{{$dataEdit->orden_active}}'>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="botonmodal">{{isset($dataEdit->id)?'Guardar':'Agregar'}}</button>
        </div>
        </div>
   
    </div>
</div> 
<script>

    $(document).ready( function () { 
            $('#modal-id').modal('show');
            @if (isset($dataEdit->id))
            $(document).on('click', '#botonmodal', function(event) {
                event.preventDefault();
                
                $("#botonmodal").attr("disabled", true);
                var datas =  {
                    name: $('#name').val(),
                    cantidad_personas: $('#cantidad_personas').val(),
                    active: $('#active').is(":checked")?1:0,
                    orden_active: $('#orden_active').val()
                }
                $.ajax({ 
                    type: "PUT",
                    url: "{{route('mesas-admin-update',$dataEdit->id)}}", 
                    data: datas,
                        }).done(function(data){
                            
                $("#botonmodal").attr("disabled", false);
                            $('#infodata').html(data)
                            $('#modal-id').modal('hide');
                            $('#table_id').DataTable( {
                                        paging: true,
                                    });
                        });
                }); 
            @else
            $(document).on('click', '#botonmodal', function(event) {
                
                $("#botonmodal").attr("disabled", true);
                event.preventDefault();
                var datas =  {
                    name: $('#name').val(),
                    cantidad_personas: $('#cantidad_personas').val(),
                    active: $('#active').val()?1:0,
                    orden_active: $('#orden_active').val()
                }
                $.ajax({ 
                    type: "post",
                    url: "{{route('mesas-admin-add')}}", 
                    data: datas,
                        }).done(function(data){
                            
                $("#botonmodal").attr("disabled", false);
                            $('#infodata').html(data)
                            $('#modal-id').modal('hide');
                            $('#table_id').DataTable( {
                                        paging: true,
                                    });
                        });
                }); 
            @endif
        } );
</script>