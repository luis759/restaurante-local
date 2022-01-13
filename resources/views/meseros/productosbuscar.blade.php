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
                        <div id="form" class="col-12 col-md-4">
                            <div class="form-group row">
                                <label for="cantidad"   class="col-sm-4 col-form-label">Cantidad :</label>
                                <div class="col-sm-7">
                                <input type="number" min="0" class="form-control" data-attr='{"precio":{{$DataProductos->precio}},"id":{{$DataProductos->id}},"tipoproducto":"{{$DataProductos->productotipo}}"}'  onchange="valorCambio(this)" id="cantiadprod{{$DataProductos->id}}p" placeholder="" value=''>
                                </div>
                            </div>
                            <label id="total">Total:</label>
                            <svg  id="eliminar" onclick="eliminar(this)" data-attr='{"id":{{$DataProductos->id}},"input":"cantiadprod{{$DataProductos->id}}p"}' width="30" height="30" fill="black" class="bi bi-pencil-square mr-2 float-right" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg> 
                            <svg  id="agregarnuevoproducto" onclick="AGREGAR(this)" data-attr='{"id":{{$DataProductos->id}},"input":"cantiadprod{{$DataProductos->id}}p"}' width="30" height="30" fill="blue" class="bi bi-pencil-square mr-2 float-right" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                            </svg> 
                            
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                
        @endforeach