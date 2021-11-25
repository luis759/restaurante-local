@foreach ($dataMesasLibres as $dataMesasLibress)
                                    <li class="list-group-item " >
                                            <div class="row m-0 p-0 align-self-center">
                                                <div class="col-4">
                                                            <svg width="60" height="60" fill="black" class="  mr-2 bi bi-credit-card-fill mb-4" data-attr=""    viewBox="0 0 26 26">
                                                            <path d="M25.484,7.114l-4.278-3.917C21.034,3.069,20.825,3,20.61,3H5.38C5.165,3,4.956,3.069,4.783,3.197
                                                                    l-4.38,4C0.403,7.197,0,7.453,0,8v2c0,0.551,0.449,1,1,1h24c0.551,0,1-0.449,1-1V8C26,7.469,25.484,7.114,25.484,7.114z"/>
                                                                <path d="M2,23c-0.551,0-1-0.449-1-1V10h3v12c0,0.551-0.449,1-1,1H2z"/>
                                                                <path  d="M23,23c-0.551,0-1-0.449-1-1V10h3v12c0,0.551-0.449,1-1,1H23z"/>
                                                                <path  d="M20,18c-0.551,0-1-0.449-1-1v-5h2v5C21,17.551,20.551,18,20,18L20,18z"/>
                                                                <path  d="M6,18c-0.551,0-1-0.449-1-1v-5h2v5C7,17.551,6.551,18,6,18L6,18z"/>
                                                            </svg>
                                                            <svg width="85" height="85" fill="black" class="bi bi-credit-card-fill" onclick="pagar('{{ route('ordenes-agregarpedido',$dataMesasLibress->id) }}')"  viewBox="0 0 26 26">
                                                            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
                                                            </svg>
                                                </div> 
                                                <div class="col-8 align-self-center">           
                                                    <p class="m-0 text-center">Nombre de la Mesa:</p>
                                                    <p class="text-center m-0 "><span class="badge badge-primary">{{$dataMesasLibress->name}}</span></p>
                                                    <p class="m-0 text-center">Cantidad de Personas:</p>
                                                    <p class="text-center m-0 "><span class="badge badge-primary">{{$dataMesasLibress->cantidad_personas}}</span></p>
                                                </div> 
                                            </div>
                                    </li>      
@endforeach
                        