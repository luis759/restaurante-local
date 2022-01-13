
<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h4 class="modal-title" id="userCrudModal"></h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" aria-hidden="true">X</button>
            </div>

            <div class="modal-body">
            <div class="form-group text-center">
                <p>Seleccionar Imagen</p>
                <img onclick="clickbotonmodalimagen()" id="imagenselec" src="{{$dataEdit->foto=='blank.png'?asset('assets/img/Productos.png'):(isset($dataEdit->foto)?asset('storage/'.$dataEdit->foto):asset('assets/img/Productos.png'))}}" alt="..." class="img-fluid" style="height:250px;">
                <input id="image" type="file" name="image" style="display:none;">
            </div>
            <div class="form-group row">
                <label for="cart" class="col-sm-4 col-form-label">Carta Producto *:</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" id="cart" placeholder="" value='{{$dataEdit->cart}}'>
                </div>
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
                <textarea class="form-control" id="descripcion" rows="3" value='{{$dataEdit->descripcion}}'>{{$dataEdit->descripcion}}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="productotipo"   class="col-sm-5 col-form-label">Tipo de Producto *:</label>
                <select class="form-control col-sm-6"  id="productotipo"   value="{{$dataEdit->productotipo}}">
                <option value="F"  {{$dataEdit->productotipo == 'F'?'selected':''}}>Frio</option>
                <option value="C"  {{$dataEdit->productotipo == 'C'?'selected':''}}>Caliente</option>
                <option value="O"  {{$dataEdit->productotipo == 'O'?'selected':''}}>Otros</option>
                </select>
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
                <button type="button" class="btn btn-success" id="botonmodal" onclick="clickbotonmodal()">{{isset($dataEdit->id)?'Guardar':'Agregar'}}</button>
        </div>
        </div>
   
    </div>
</div> 
<script>

    $(document).ready( function () { 
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

        } );
        function clickbotonmodalimagen(){
            $('#image').click()
        }
        @if (isset($dataEdit->id))
            function clickbotonmodal(){
                 fds = new FormData();
                 files = $('#image')[0].files;
                if(files.length > 0 ){
                    fds.append('image',files[0])
                }else{
                    }
                    fds.append('nombre',$('#nombre').val())
                    fds.append('cart',$('#cart').val())
                    fds.append('productotipo',$('#productotipo').val())
                    fds.append('stock',$('#stock').val())
                    fds.append('precio',$('#precio').val())
                    fds.append('descripcion',$('#descripcion').val())
                console.log(fds.get('nombre'))
                $.ajax({ 
                    type: "post",
                    url: "{{route('productos-admin-update',$dataEdit->id)}}", 
                    contentType: false,
                    processData: false,
                    data: fds,
                        }).done(function(data){
                            $('#infodata').html('')
                            $('#infodata').html(data)
                            $('#modal-id').modal('hide');
                            $('#table_id').DataTable( {
                                        paging: true,
                                    });
                        });
            }
            @else
            function clickbotonmodal(){
                var fd = new FormData();
                var files = $('#image')[0].files;
                if(files.length > 0 ){
                fd.append('image',files[0])
                }else{
                    }
                fd.append('nombre',$('#nombre').val())
                fd.append('stock',$('#stock').val())
                fd.append('cart',$('#cart').val())
                fd.append('productotipo',$('#productotipo').val())
                fd.append('precio',$('#precio').val())
                fd.append('descripcion',$('#descripcion').val())
                $.ajax({ 
                    type: "post",
                    url: "{{route('productos-admin-add')}}", 
                    contentType: false,
                    processData: false,
                    data: fd,
                        }).done(function(data){
                            
                $("#botonmodal").attr("disabled", false);
                            $('#infodata').html(data)
                            $('#modal-id').modal('hide');
                            $('#table_id').DataTable( {
                                        paging: true,
                                    });
                        });
            }
            @endif
</script>