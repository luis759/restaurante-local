<div class="row">
            <div class="col-12 col-md-8">
            
            </div>
            <div class="col-12 col-md-4">
                        <div class="list-group h-100" style="max-height: 300px;overflow:auto;-webkit-overflow-scrolling: touch;">
                                <button type="button" class="list-group-item list-group-item-action">
                                    Cras justo odio
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">Dapibus ac facilisis in</button>
                                <button type="button" class="list-group-item list-group-item-action">Morbi leo risus</button>
                                <button type="button" class="list-group-item list-group-item-action">Porta ac consectetur ac</button>
                                <button type="button" class="list-group-item list-group-item-action" disabled>Vestibulum at eros</button>
                        </div>
            </div>
</div>

<script>
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
</script>
