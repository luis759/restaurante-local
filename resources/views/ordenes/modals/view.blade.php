
<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h4 class="modal-title" id="userCrudModal"></h4>
                <div class="row text-right">
            
                    <label for="name" class="col-12">CODIGO : {{$dataEdit->codigo}}</label>
                     <label for="name" class="col-12">FECHA : {{$dataEdit->fecha}}</label>
                </div>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" aria-hidden="true">X</button>
                
            </div>

            <div class="modal-body">

                <div class="row">
                    <div class="col-6">
                        <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" value="" id="delivery" {{empty($dataEdit->tipodeorden)?'':($dataEdit->tipodeorden=='D'?'checked':'')}}>
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
                        <select  class=" selectpicker form-control col-sm-8"  id="mesero" style="width: 70%;" value="{{$dataEdit->id_usuario}}">  
                        @foreach ($DataMesero as $DataMesero)
                        <option value="{{$DataMesero->id}}" data-attr="{{ $DataMesero->id_nivel==2?10:0}}" {{ $dataEdit->id_usuario== $DataMesero->id  ?'selected="selected"':''}}>{{$DataMesero->nombre}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                                <label for="propina"   class="col-sm-7 col-form-label">Propina :</label>
                                <div class="col-sm-4">
                                <input type="number" min="0" class="form-control" id="propina" placeholder="" value='{{$dataEdit->propina}}'>
                                </div>
                            </div>
                    </div>
                    <div class="col-12 ">
                        <div class="form-group row">
                            <label for="Mesa"   class="col-sm-3 col-form-label">Mesa *:</label>
                            <select class=" selectpicker form-control col-sm-8"  id="Mesa" style="width: 70%;" value="{{$dataEdit->id_mesa}}">  
                            @foreach ($DataMesa as $DataMesa)
                            <option value="{{$DataMesa->id}}" {{ $dataEdit->id_mesa== $DataMesa->id  ?'selected="selected"':''}} >{{$DataMesa->nombre}}</option>
                            @endforeach
                            </select>
                        </div>
                       
                    </div>

                    <div class="col-12">
                    <div class="form-group row">
                                <label for="observaciones"   class="col-sm-4 col-form-label">Observaciones :</label>
                                <div class="col-sm-8">
                                <input type="text" class="form-control" id="observaciones" placeholder="Comentario" value='{{$dataEdit->observaciones}}'>
                                </div>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="mesero"   class="col-sm-3 col-form-label">Producto *:</label>
                        <select class="selectpicker form-control col-sm-8"  style="width: 70%;" id="productos">  
                        <option value='{"dat":0,"dat1":0}' >Seleccion un Producto</option>
                        @foreach ($DataProductos as $DataProductos)
                        <option value='{"dat":{{$DataProductos->id}},"dat1":{{$DataProductos->precio}},"dat2":"{{$DataProductos->nombre}}","dat3":"{{$DataProductos->productotipo}}"}' data-image="{{asset('storage/'.$DataProductos->foto)}}" >{{$DataProductos->cart}}</option>
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
                                <input type="number" min="0" class="form-control" id="cantidad" placeholder="" value=''>
                                </div>
                            </div>
                    </div>
                    <div class="col-5">
                            <div class="form-group row">
                                <label for="total"   class="col-sm-4 col-form-label">Total :</label>
                                <div class="col-sm-7">
                                <input type="number" min="0" disabled class="form-control" id="total" placeholder="" value=''>
                                </div>
                            </div>
                    </div>
                    
                    <div class="col-1">
                            <svg  id="agregarnuevoproducto" onclick="agregarproductos()" width="30" height="30" fill="blue" class="bi bi-pencil-square mr-2" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                            </svg> 
                    </div>
                </div>
                
                <div class="row">
                        <div class="col-12" id="infoProductos">
                        
                        </div>
                </div>
                <div class="modal-footer">
              <div class="col-12">
                    <label id="TotalFacturado" class="float-left">Total :</label>
                <button type="button" class="btn btn-success float-right" id="botonmodal" onclick="clickbotonmodal()">{{isset($dataEdit->id)?'Guardar':'Agregar'}}</button>
                </div>
              
            </div>
            </div>
           
        </div>
   
    </div>
</div> 
<script>
   
    var produc=[];
    var total=0;
    var subt=0;
    $(document).ready( function () { 
        retirarData()
        $(".selectpicker").select2({
            templateResult: formatState, 
            theme: "bootstrap-5",
        });

        $("#cantidad").change(function() {
            var data=JSON.parse($("#productos").val());
            $("#total").val($(this).val()*data['dat1'])  

        })
        $("#propina").change(function() {
            total=total+($("#propina").val()*1)
            $('#TotalFacturado').html('Total : '+total+ '  $')
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

            $('#modal-id').modal('show');
            
          
        } );
        function gettotal(){
           total=0
            for (var i = 0; i < produc.length; i++) {
                total=total+(produc[i]['total']*1)
            }
            subt=total;
            var porcentual=$("#mesero option:selected").attr('data-attr')/100
            $("#propina").val(Math.round(porcentual*total * 100) / 100);
            
            total=total+($("#propina").val()*1)
            $('#TotalFacturado').html('Total : '+total+ '  $')
        }
     function agregarproductos(){
                var productos=JSON.parse($("#productos").val());
                var valortotal=$("#total").val()
                var valorcantidad=$("#cantidad").val()
                var valor=productos['dat1']
                var valor2=productos['dat']
                var nombreproducto=productos['dat2']
                var tipoproducto=productos['dat3']
                var objeto={
                    total:valortotal,
                    valorcantidad:valorcantidad,
                    valor:valor,
                    valor2:valor2,
                    nombreproducto:nombreproducto,
                    tipoproducto:tipoproducto
                }
                produc.push(objeto)
                $("#cantidad").val('')
                $("#total").val('')
                $("#dataproductosagre").css( "display","none" );
                $("#productos").val('{"dat":0,"dat1":0}').change()
                showDatainfo(produc)
                gettotal()
     }
function showDatainfo (arrays){
    
    if(arrays){
        if(arrays.length>0){
            var htmllist="<ul class='list-group'>";
            for (var i = 0; i < arrays.length; i++) {
            htmllist=htmllist+"<li class='list-group-item'><div class='row'><div class='col-9'><p>PRODUCTO:"+arrays[i]['nombreproducto']+"</p> CANTIDAD: "+arrays[i]['valorcantidad'] +" SUBTOTAL: "+arrays[i]['total']+"  $";
            htmllist=htmllist+"</div><div class='col-2 align-self-center' '> <svg  onclick='deletes("+i+")' width='30' height='30' fill='red' class='bi bi-x-square-fill' viewBox='0 0 16 16'>";
            htmllist=htmllist+"<path d='M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z'/>";
            htmllist=htmllist+"</svg></div></div>";
            htmllist=htmllist+"</li>";
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
function deletes (valor) {
    produc.splice(valor,1)
    showDatainfo(produc)
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
@if (isset($ProductoSelec))
                function retirarData(){
                    valor=JSON.parse(' {!! $ProductoSelec !!} ')
                    produc=valor
                showDatainfo(produc)
                gettotal()
                }
    @else

    @endif
@if (isset($dataEdit->id))
            function clickbotonmodal(){
                var datas =  {
                    subtotal: subt,
                    total: total,
                    id_mesa:$("#Mesa").val(),
                    id_usuario: $('#mesero').val(),
                    observaciones: $('#observaciones').val(),
                    tipodeorden:$('#delivery').is(":checked")?'D':'L',
                    propina:$('#propina').val(),
                    pagado:$('#pagado').is(":checked")?1:0,
                    productos:JSON.stringify(produc)
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
            }
            @else
            function clickbotonmodal(){
                var datas =  {
                    subtotal: subt,
                    total: total,
                    id_mesa:$("#Mesa").val(),
                    id_usuario: $('#mesero').val(),
                    observaciones: $('#observaciones').val(),
                    tipodeorden:$('#delivery').is(":checked")?'D':'L',
                    propina:$('#propina').val(),
                    pagado:$('#pagado').is(":checked")?1:0,
                    productos:JSON.stringify(produc)
                }
                $.ajax({ 
                    type: "POST",
                    url: "{{route('ordenes-admin-add')}}", 
                    data: datas,
                        }).done(function(data){
                            $('#infodata').html(data)
                            $('#modal-id').modal('hide');
                            $('#table_id').DataTable( {
                                        paging: true,
                                    });
                        });
            }
            @endif
</script>