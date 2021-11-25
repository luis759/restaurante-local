@foreach ($DataProducto as $DataProductos)
                                    <li class="list-group-item " >
                                            <div class="row m-0 p-0 align-self-center">
                                                <div class="col-4">
                                                <img src="{{$DataProductos->foto=='blank.png'?asset('assets/img/producto.jpg'):asset('storage/'.$DataProductos->foto)}}" class="img-fluid rounded" alt="...">
                                                </div> 
                                                <div class="col-8 align-self-center">           
                                                    <p class="m-0 text-center">Cart:</p>
                                                    <p class="text-center m-0 "><span class="badge badge-primary">{{$DataProductos->cart}}</span></p>
                                                    <p class="m-0 text-center">Nombre del Producto:</p>
                                                    <p class="text-center m-0 "><span class="badge badge-primary">{{$DataProductos->nombre}}</span></p>
                                                    <p class="m-0 text-center">Cantidad:</p>
                                                    <p class="text-center m-0 "><span class="badge badge-primary">{{$DataProductos->cantidad}}</span></p>
                                                </div> 
                                            </div>
                                    </li>      
@endforeach