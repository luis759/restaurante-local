<div class="row mb-6">

            <div class="col-12">
            
            <div class="accordion accordion-flush" id="accordionFlushExample" style="padding-bottom:100px;" >
            @foreach ($DataProductos as $DataProductos)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{$DataProductos->id}}" aria-expanded="false" aria-controls="flush-collapseOne">
                         <div class="row w-100">
                        <div class="col-3">
                        <img src="{{$DataProductos->foto=='blank.png'?asset('assets/img/producto.jpg'):asset('storage/'.$DataProductos->foto)}}" class="img-fluid rounded" alt="...">
                        </div>  
                        <div class="col-4">
                        
                        <label >Carta: {{$DataProductos->cart}}</label>
                        </div>  
                        <div class="col-5 float-right">
                        
                        <label>Precio: {{$DataProductos->precio}}$</label>
                        </div>  
                       </div>
                    </button>
                  
                    </h2>
                    <div id="flush-collapseOne{{$DataProductos->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="row">
                        <div class="col-12 col-md-8 d-flex  flex-wrap text-break">
                        Descripcion:  {{$DataProductos->descripcion}} 
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group row">
                                <label for="cantidad"   class="col-sm-4 col-form-label">Cantidad :</label>
                                <div class="col-sm-7">
                                <input type="number" min="0" class="form-control" data-attr='{"precio":{{$DataProductos->precio}},"id":{{$DataProductos->id}}}'  onchange="valorCambio(this)" id="cantiadprod{{$DataProductos->id}}p" placeholder="" value=''>
                                </div>
                            </div>
                            <label id="total">Total:</label>
                            <svg  id="agregarnuevoproducto" onclick="AGREGAR(this)" data-attr='{"id":{{$DataProductos->id}},"input":"cantiadprod{{$DataProductos->id}}p","total":"total{{$DataProductos->id}}p"}' width="30" height="30" fill="blue" class="bi bi-pencil-square mr-2 float-right" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                            </svg> 
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                
            @endforeach
                </div>
            </div>
</div>

<script>
    function valorCambio(valor){
        let total =$(valor).val();
        let json=JSON.parse($(valor).attr('data-attr'))
        let precio=json['precio']
        let id=json['id']
        $(valor).parent().parent().children( "#total" ).html("Total:  "+(total*1)*(precio*1))
    }
    function AGREGAR(valor){
        let data=JSON.parse($(valor).attr('data-attr'))
        console.log(data)
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
</script>
