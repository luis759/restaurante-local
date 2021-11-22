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