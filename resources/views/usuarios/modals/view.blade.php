
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
                     <input  type="text" class="form-control" id="name" placeholder="Nombre" value='{{$dataEdit->name}}'>
                    </div>
                </div>
            <div class="form-group row">
                <label for="id_nivel"   class="col-sm-3 col-form-label">Nivel *:</label>
                <select class="form-control col-sm-8"  id="id_nivel"   value="{{$dataEdit->id_nivel}}">
                @foreach ($DataNiveles as $DataNiveles)
                        <option value="{{$DataNiveles->id}}"  {{$dataEdit->id_nivel == $DataNiveles->id?'selected':''}}>{{$DataNiveles->name}}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label">Correo *:</label>
                <div class="col-sm-8">
                     <input {{$opcion?'':'disabled'}}  type="email" class="form-control" id="email" placeholder="Correo@g.com" value='{{$dataEdit->email}}'>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-5 col-form-label">{{$opcion?'':'Cambiar'}} Contraseña *:</label>
                <div class="col-sm-7">
                     <input type="password" class="form-control" id="password" placeholder="" value=''>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-5 col-form-label">Repetir Contraseña *:</label>
                <div class="col-sm-7">
                     <input type="password" class="form-control" id="password_confirmation" placeholder="" value=''>
                </div>
            </div>
            <input type="hidden" id="passverifi"value='{{$dataEdit->password}}'>
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
                    id_nivel: $('#id_nivel').val(),
                    password: $('#password').val(),
                    password_confirmation: $('#password_confirmation').val(),
                    email: $('#email').val()
                }
                $.ajax({ 
                    type: "PUT",
                    url: "{{route('usuarios-admin-update',$dataEdit->id)}}", 
                    data: datas,
                        }).done(function(data){
                            $('#infodata').html(data)
                            $('#modal-id').modal('hide');
                            $('#table_id').DataTable( {
                                        paging: true,
                                    });
                                    
                $("#botonmodal").attr("disabled", false);
                        });
                }); 
            @else
            $(document).on('click', '#botonmodal', function(event) {
                event.preventDefault();
                $("#botonmodal").attr("disabled", true);
                var datas =  {
                    name: $('#name').val(),
                    id_nivel: $('#id_nivel').val(),
                    password: $('#password').val(),
                    password_confirmation: $('#password_confirmation').val(),
                    email: $('#email').val()
                }
                console.log(datas)
                $.ajax({ 
                    type: "post",
                    url: "{{route('usuarios-admin-add')}}", 
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