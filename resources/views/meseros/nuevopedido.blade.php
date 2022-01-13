<div class="row ">

            <div class="col-12">
            
            <div class="accordion accordion-flush" id="accordionFlushExample" style="" >
            @include('meseros.productosbuscar')
                </div>
            </div>
</div>

<script>
    var produc=[]
    function valorCambio(valor){
        let total =$(valor).val();
        let json=JSON.parse($(valor).attr('data-attr'))
        let precio=json['precio']
        let id=json['id']
        $(valor).parent().parent().parent().children( "#total" ).html("Total:  "+(total*1)*(precio*1))
    }
    function AGREGAR(valor){
        let data=JSON.parse($(valor).attr('data-attr'))
        let input=$("#"+data['input'])
        let tot=$("#"+data['input']).val()
        let json=JSON.parse(input.attr('data-attr'))
        let precio=json['precio']
        let id=json['id']
        let tipoproductos=json['tipoproducto']
        let total=(tot*1)*(precio*1)
        var objeto={
            id:id,
            precios:precio,
            subtotal:total,
            cantidad:tot,
            tipoproducto:tipoproductos
        }
        produc.push(objeto)
        $(valor).attr('onclick','')
        $(valor).attr('fill','black')
        input.prop('disabled', true)
        $(valor).parent().children( "#eliminar" ).attr('onclick','eliminar(this)')
        $(valor).parent().children( "#eliminar" ).attr('fill','blue')
        $(valor).parent().parent().parent().parent().parent().children('.accordion-header').children('.accordion-button').addClass('borderacordionactive')
        getTotal()
    }
    function buscartexto(){
        $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
                var datas =  {
                    opcion: $('#opcionbuscar').val(),
                    valorbuscar: $("#cartabuscar").val()
                }
                $.ajax({ 
                    type: "POST",
                    url: "{{route('productos-buscar')}}", 
                    data: datas,
                        }).done(function(data){
                            if(data['success']){
                             $('#accordionFlushExample').html('')
                             $('#accordionFlushExample').html(data['productos'])
                             valoresCambiosAutomaticosBuscador()
                            }
                        });
    }
    function eliminar(valor){
        let data=JSON.parse($(valor).attr('data-attr'))
        let input=$("#"+data['input'])
        let json=input.attr('data-attr')
        let id=data['id']
        let lugar=0
       for(var i=0;i<produc.length;i++){
           if(produc[i]['id']==id){
             $(valor).attr('onclick','')
             $(valor).attr('fill','black')
             input.prop('disabled', false)
             input.val('')
             lugar=i
             $(valor).parent().children( "#agregarnuevoproducto" ).attr('onclick','AGREGAR(this)')
             $(valor).parent().children( "#agregarnuevoproducto" ).attr('fill','blue')
             $(valor).parent().parent().parent().parent().parent().children('.accordion-header').children('.accordion-button').removeClass('borderacordionactive')
 
             $(valor).parent().children( "#total" ).html("Total:  ")
           }
       }
       
        produc.splice(lugar,1)
        getTotal()
    }
    function valoresCambiosAutomaticosBuscador(){
                for(var  i = 0; i < produc.length; i++){
                    let objeto=$('#flush-collapseOne'+produc[i]['id'])
                    objeto.children('.accordion-body').children('.row').children('#form').children('#agregarnuevoproducto').attr('onclick','')
                    objeto.children('.accordion-body').children('.row').children('#form').children('#agregarnuevoproducto').attr('fill','black')
                    $('#cantiadprod'+produc[i]['id']+'p').val(produc[i]['cantidad'])
                    $('#cantiadprod'+produc[i]['id']+'p').prop('disabled', true)
                    $('#cantiadprod'+produc[i]['id']+'p').parent().parent().parent().children( "#total" ).html("Total:  "+produc[i]['subtotal'])
                    objeto.children('.accordion-body').children('.row').children('#form').children( "#eliminar" ).attr('onclick','eliminar(this)')
                    objeto.children('.accordion-body').children('.row').children('#form').children( "#eliminar" ).attr('fill','blue')
                    objeto.parent().children('.accordion-header').children('.accordion-button').addClass('borderacordionactive') 
                    getTotal()
                }
    }
    @if(isset($dataOrdenes))
    $(document).ready( function () {
        valoresCambiosAutomaticos()
    })
    function valoresCambiosAutomaticos(){
                produc=JSON.parse(' {!! $dataProductoSelec !!} ')
                for(var  i = 0; i < produc.length; i++){
                    let objeto=$('#flush-collapseOne'+produc[i]['id'])
                    objeto.children('.accordion-body').children('.row').children('#form').children('#agregarnuevoproducto').attr('onclick','')
                    objeto.children('.accordion-body').children('.row').children('#form').children('#agregarnuevoproducto').attr('fill','black')
                    $('#cantiadprod'+produc[i]['id']+'p').val(produc[i]['cantidad'])
                    $('#cantiadprod'+produc[i]['id']+'p').prop('disabled', true)
                    $('#cantiadprod'+produc[i]['id']+'p').parent().parent().parent().children( "#total" ).html("Total:  "+produc[i]['subtotal'])
                    objeto.children('.accordion-body').children('.row').children('#form').children( "#eliminar" ).attr('onclick','eliminar(this)')
                    objeto.children('.accordion-body').children('.row').children('#form').children( "#eliminar" ).attr('fill','blue')
                    objeto.parent().children('.accordion-header').children('.accordion-button').addClass('borderacordionactive') 
                    getTotal()
                }
            }
           
    function clickEditar(){
        $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
                var datas =  {
                    subtotal: $('#sutotalfooter').html()*1,
                    total: $('#totalfooter').html()*1,
                    observaciones: $('#observaciones').val(),
                    propina:$('#propinafooter').html()*1,
                    productos:JSON.stringify(produc)
                }
                $.ajax({ 
                    type: "PUT",
                    url: "{{route('ordenes-editarpedido-idorden',$dataOrdenes->id)}}", 
                    data: datas,
                        }).done(function(data){
                            if(data['success']){
                                window.location.href="{{route('home')}}"
                            }else{
                            $('#toastMessage').html(data['data'])
                            $('.toast').toast("show")
                            }
                        });
    }        
     @else
     function clickbotonmodal(){
        $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
                var datas =  {
                    subtotal: $('#sutotalfooter').html()*1,
                    total: $('#totalfooter').html()*1,
                    observaciones: $('#observaciones').val(),
                    propina:$('#propinafooter').html()*1,
                    productos:JSON.stringify(produc)
                }
                $.ajax({ 
                    type: "POST",
                    url: "{{route('ordenes-agregarpedido-mesa',$idmesa)}}", 
                    data: datas,
                        }).done(function(data){
                            if(data['success']){
                                window.location.href="{{route('home')}}"
                            }else{
                            $('#toastMessage').html(data['data'])
                            $('.toast').toast("show")
                            }
                        });
        }       
    @endif
   function getTotal(){
       let sas=0
       for(let k=0;k<produc.length;k++){
        sas=sas+(produc[k]['subtotal']*1)
       }
       let subtotal=Math.round( sas * 100) / 100
       let propina=Math.round( (subtotal*0.10 )* 100) / 100
       let totales=subtotal+propina
       $('#sutotalfooter').html(subtotal)
       $('#propinafooter').html(propina)
       $('#totalfooter').html(totales)
    }
</script>
