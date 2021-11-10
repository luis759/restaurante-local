
<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h4 class="modal-title" id="userCrudModal"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="modal-body">
            <div class="form-group text-center">
                <p>Seleccionar Imagen</p>
                <img id="imagenselec" src="{{asset('assets/img/Productos.png')}}" alt="..." class="img-fluid" style="height:250px;">
                <input id="image" type="file" name="image" style="display:none;">
            </div>
            <div class="form-group row">
                <label for="nombre" class="col-sm-4 col-form-label">Nombre Producto *:</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" id="nombre" placeholder="" value='{{$dataEdit->nombre}}'>
                </div>
            </div>
            <div class="form-group row">
                <label for="descripcion" class="col-sm-4 col-form-label">Descripcion Producto *:</label>
                <div class="col-sm-8">
                <textarea class="form-control" id="descripcion" rows="3" value='{{$dataEdit->descripcion}}'></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="stock" class="col-sm-4 col-form-label">Stock *:</label>
                <div class="col-sm-8">
                <input class="form-control" type="number" id="stock" value='{{$dataEdit->stock}}'>
                </div>
            </div>
            <div class="form-group row">
                <label for="precio" class="col-sm-4 col-form-label">Precio *:</label>
                <div class="col-sm-8">
                <input type="number" class="form-control" id="precio" placeholder="" value='{{$dataEdit->precio}}'>
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
        $(document).on('click', '#imagenselec', function(event) {
            $('#image').click()
        })
        $("#image").change(function(){
            var input = this;
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && ( ext == "png" || ext == "jpeg" || ext == "jpg")) 
            {
                var reader = new FileReader();
                reader.onload = function (e) {
                $('#imagenselec').attr('src', e.target.result);
                }
                 reader.readAsDataURL(input.files[0]);
            }
            else
            {
            $('#imagenselec').attr('src', '');
            }
        });

            $('#modal-id').modal('show');
            @if (isset($dataEdit->id))
            $(document).on('click', '#botonmodal', function(event) {
                event.preventDefault();
                var datas =  {
                    name: $('#name').val(),
                    cantidad_personas: $('#cantidad_personas').val(),
                    active: $('#active').is(":checked")?1:0,
                    orden_active: $('#orden_active').val()
                }
                $.ajax({ 
                    type: "PUT",
                    url: "{{route('productos-admin-update',$dataEdit->id)}}", 
                    data: datas,
                        }).done(function(data){
                            $('#infodata').html(data)
                            $('#modal-id').modal('hide');
                            $('#table_id').DataTable( {
                                        paging: true,
                                    });
                        });
                }); 
            @else
            $(document).on('click', '#botonmodal', function(event) {
                event.preventDefault();
                var fd = new FormData();
                var files = $('#image')[0].files;
                if(files.length > 0 ){
                fd.append('image',files[0])
                }else{
                    }
                fd.append('nombre',$('#nombre').val())
                fd.append('stock',$('#stock').val())
                fd.append('precio',$('#precio').val())
                fd.append('descripcion',$('#descripcion').val())
                $.ajax({ 
                    type: "post",
                    url: "{{route('productos-admin-add')}}", 
                    contentType: false,
                    processData: false,
                    data: fd,
                        }).done(function(data){
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