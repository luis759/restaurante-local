
<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h4 class="modal-title" id="userCrudModal"></h4>
                <div class="row text-right">
            
                    <label for="name" class="col-12">CODIGO : {{$dataEdit->codigo}}</label>
                     <label for="name" class="col-12">FECHA : {{$dataEdit->fecha}}</label>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>

            <div class="modal-body">

                <div class="row">
                    <div class="col-6">
                        <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" value="" id="delivery" {{$dataEdit->tipodeorden='D'?'checked':''}}>
                        <label class="form-check-label" for="delivery">
                            Delivery *
                        </label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" value="" id="pagado" {{$dataEdit->pagado?'checked':''}}>
                        <label class="form-check-label" for="pagado">
                        Pagado *
                        </label>
                        </div>
                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="form-group row">
                        <label for="mesero"   class="col-sm-3 col-form-label">Mesero *:</label>
                        <select class=" selectpicker form-control col-sm-8"  id="mesero" style="width: 70%;">  
                        @foreach ($DataMesero as $DataMesero)
                        <option value="{{$DataMesero->id}}" >{{$DataMesero->nombre}}</option>
                        @endforeach
                        </select>
                    </div>

                    </div>
                    <div class="col-12 ">
                        <div class="form-group row">
                            <label for="Mesa"   class="col-sm-3 col-form-label">Mesa *:</label>
                            <select class=" selectpicker form-control col-sm-8"  id="Mesa" style="width: 70%;">  
                            @foreach ($DataMesa as $DataMesa)
                            <option value="{{$DataMesa->id}}" >{{$DataMesa->nombre}}</option>
                            @endforeach
                            </select>
                        </div>
                       
                    </div>

                    <div class="col-12">
                    <div class="form-group row">
                        <label for="mesero"   class="col-sm-3 col-form-label">Producto *:</label>
                        <select class="selectpicker form-control col-sm-8"  style="width: 70%;" id="productos">  
                        <option value='{"dat":0,"dat1":0}' >Seleccion un Producto</option>
                        @foreach ($DataProductos as $DataProductos)
                        <option value='{"dat":{{$DataProductos->id}},"dat1":{{$DataProductos->precio}},"dat2":"{{$DataProductos->nombre}}"}' data-image="{{asset('storage/'.$DataProductos->foto)}}" >{{$DataProductos->nombre}}</option>
                        @endforeach
                        </select>
                    </div>

                    </div>

                   

                </div>
                
                <div class="row" id="dataproductosagre" style="display:none;">
                    <div class="col-5">
                            <div class="form-group row">
                                <label for="cantidad"   class="col-sm-4 col-form-label">Cantidad :</label>
                                <div class="col-sm-7">
                                <input type="number" class="form-control" id="cantidad" placeholder="" value=''>
                                </div>
                            </div>
                    </div>
                    <div class="col-5">
                            <div class="form-group row">
                                <label for="total"   class="col-sm-4 col-form-label">Total :</label>
                                <div class="col-sm-7">
                                <input type="number"  disabled class="form-control" id="total" placeholder="" value=''>
                                </div>
                            </div>
                    </div>
                    
                    <div class="col-1">
                            <svg  id="agregarnuevoproducto" width="30" height="30" fill="blue" class="bi bi-pencil-square mr-2" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg> 
                    </div>
                </div>
                
                <div class="row">
                        <div class="col-12" id="infoProductos">
                        
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
    var produc=[];
    $(document).ready( function () { 
        $(".selectpicker").select2({
            templateResult: formatState
        });

        $("#cantidad").change(function() {
            var data=JSON.parse($("#productos").val());
            $("#total").val($(this).val()*data['dat1'])  

        })

        $("#productos").change(function() {
                 var data=JSON.parse($(this).val());
                if(data['dat']==0){
                $("#dataproductosagre").css( "display","none" );

                }else{
                $("#dataproductosagre").show( "fast" );

                }
                $("#cantidad").val('')
                $("#total").val('')
        });

        $(document).on('click', '#agregarnuevoproducto', function(event) {
                event.preventDefault();
                console.log($("#productos").val())
                var productos=JSON.parse($("#productos").val());
                console.log(productos)
                var valortotal=$("#total").val()
                var valorcantidad=$("#cantidad").val()
                var valor=productos['dat1']
                var valor2=productos['dat']
                var nombreproducto=productos['dat2']
                var objeto={
                    total:valortotal,
                    valorcantidad:valorcantidad,
                    valor:valor,
                    valor2:valor2,
                    nombreproducto:nombreproducto
                }
                produc.push(objeto)
                console.log(produc)
                $("#cantidad").val('')
                $("#total").val('')
                $("#dataproductosagre").css( "display","none" );
                $("#productos").val('{"dat":0,"dat1":0}').change()
                showDatainfo(produc)
        })
        
            $('#modal-id').modal('show');
            
            @if (isset($dataEdit->id))
            $(document).on('click', '#botonmodal', function(event) {
                event.preventDefault();
                var datas =  {
                    name: $('#name').val(),
                    cantidad_personas: $('#cantidad_personas').val(),
                    active: $('#active').is(":checked")?1:0,
                    orden_active: $('#orden_active').val()00.
                     
                }
                $.ajax({ 
                    type: "PUT",
                    url: "{{route('ordenes-admin-update',$dataEdit->id)}}", 
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
                var datas =  {
                    name: $('#name').val(),
                    cantidad_personas: $('#cantidad_personas').val(),
                    active: $('#active').val()?1:0,
                    orden_active: $('#orden_active').val()
                }
                $.ajax({ 
                    type: "post",
                    url: "{{route('ordenes-admin-add')}}", 
                    data: datas,
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
     
function showDatainfo (arrays){
    
    if(arrays){
        if(arrays.length>0){
            var htmllist="<ul class='list-group'>";
            for (var i = 0; i < arrays.length; i++) {
            htmllist=htmllist+"<li class='list-group-item disabled'>PRODUCTO:"+arrays[i]['nombreproducto']+" CANTIDAD: "+arrays[i]['valorcantidad'] +" SUBTOTAL: "+arrays[i]['total']+"</li>";
            }
            htmllist=htmllist+"</ul>";
            $('#infoProductos').html(htmllist)
        }else{
            $('#infoProductos').html('')
        }
    }else{
        $('#infoProductos').html('')
    }
}
function formatState (opt) {
    if (!opt.id) {
        return opt.text.toUpperCase();
    } 

    var optimage = $(opt.element).attr('data-image'); 
    if(!optimage){
       return opt.text.toUpperCase();
    } else {                    
        var $opt = $(
           '<img src="' + optimage + '" width="30px" height="30px" /><span> ' + opt.text.toUpperCase() + '</span>'
        );
        return $opt;
    }
};
</script>