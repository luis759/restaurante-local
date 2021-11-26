<div class="row">
<div class="col-12 col-md-5 h-100" >
    <div class="card">
                <div class="card-header text-center">
                        Mesas Tomadas por ti
                </div>
                <div class="card-body">
                <ul class="list-group h-100 align-self-center" style="max-height: 300px;overflow:auto;-webkit-overflow-scrolling: touch;">
                    @foreach ($dataOrdenesSelect as $dataOrdenesSelects)
                                    <li class="list-group-item "  onclick="seleccionorden(this)" data-attr="{{route('ordenes-get-produc',$dataOrdenesSelects->id)}}" data-id="{{$dataOrdenesSelects->id}}">
                                            <div class="row m-0 p-0">
                                                <div class="col-3">
                                                <svg width="50" height="50" fill="green" class="bi bi-credit-card-fill mb-4"  viewBox="0 0 26 26">
                                                <path d="M25.484,7.114l-4.278-3.917C21.034,3.069,20.825,3,20.61,3H5.38C5.165,3,4.956,3.069,4.783,3.197
                                                        l-4.38,4C0.403,7.197,0,7.453,0,8v2c0,0.551,0.449,1,1,1h24c0.551,0,1-0.449,1-1V8C26,7.469,25.484,7.114,25.484,7.114z"/>
                                                    <path d="M2,23c-0.551,0-1-0.449-1-1V10h3v12c0,0.551-0.449,1-1,1H2z"/>
                                                    <path  d="M23,23c-0.551,0-1-0.449-1-1V10h3v12c0,0.551-0.449,1-1,1H23z"/>
                                                    <path  d="M20,18c-0.551,0-1-0.449-1-1v-5h2v5C21,17.551,20.551,18,20,18L20,18z"/>
                                                    <path  d="M6,18c-0.551,0-1-0.449-1-1v-5h2v5C7,17.551,6.551,18,6,18L6,18z"/>
                                                </svg>
                                                <svg id="pagar"  data-attr="{{route('ordenes-pagado', $dataOrdenesSelects->id)}}"  width="50" height="50" fill="black" class="bi bi-credit-card-fill" viewBox="0 0 16 16">
                                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v1H0V4zm0 3v5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7H0zm3 2h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1z"/>
                                                </svg>
                                                </div> 
                                                <div class="col-9">           
                                                    <p class="m-0 text-center">Nombre de la Mesa:</p>
                                                    <p class="text-center m-0 "><span class="badge badge-primary">{{$dataOrdenesSelects->name}}</span></p>
                                                    <p class="m-0 text-center">Codigo de la Orden:</p>
                                                    <p class="text-center m-0 "><span class="badge badge-primary">{{$dataOrdenesSelects->codigo}}</span></p>
                                                    <p class="m-0 text-center">Total $:</p>
                                                    <p class="text-center m-0 "><span class="badge badge-success">{{$dataOrdenesSelects->total}}</span></p> 
                                                </div> 
                                            </div>
                                        </li>      
                    @endforeach
                        
                    </ul>
                </div>
    </div>
    
    <div class="card">
                <div class="card-header text-center">
                Productos De la mesa
                <svg  id="editValue" data-attr="" width="30" height="30" fill="balck" class="bi bi-pencil-square ml-4" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                </svg>  
                </div>
                <div class="card-body">
                <ul class="list-group h-100 align-self-center" style="max-height: 300px;overflow:auto;-webkit-overflow-scrolling: touch;" id="productosCard">  
                </ul>
                </div>
    </div>
</div>


<div class="col-12 col-md-7 h-100" >

<div class="card">
                <div class="card-header text-center">
                Mesas Disponibles
                </div>
                <div class="card-body">
                <ul class="list-group h-100 align-self-center" style="max-height: 300px;overflow:auto;-webkit-overflow-scrolling: touch;" id="mesaslibres">
                 @include('meseros.sides.mesasactiva')
                    </ul>
                </div>
    </div>


    </div>
</div>

@include('resourcestoast.toast')
<script>

        $(document).on('click', '#pagar', function(event) {
            event.preventDefault();
            let documenot= $(this)
            let documenotClear= $(this).parent().parent().parent()
            let href = $(this).attr('data-attr');
            if(href){

                $.ajax({
                        url: href,
                        type:'GET'
                    }).done(function(data){
                         let valorRetorno = data
                         if(valorRetorno['success']){
                            $('#mesaslibres').html(valorRetorno['mesaslibre'])
                            $('#productosCard').html('')
                            documenotClear.remove()
                            $('#toastMessage').html(valorRetorno['message'])
                            $('.toast').toast("show")
                         }
                    });

            }
          
        });
        function seleccionorden(orden){
            let valor=$(orden).attr('data-attr')
            let valorid = '{{ route('ordenes-editarpedidos') }}'+'/'+$(orden).attr('data-id');
            $.ajax({
                        url: valor,
                        type:'GET'
                    }).done(function(data){
                            $('#editValue').attr('fill','blue')
                            $('#editValue').attr('data-attr',valorid)
                            $('#editValue').attr('onclick','irabuscar(this)')
                            $('#productosCard').html(data)
                    });
        }
        function pagar(ir){
            window.location.href=ir
        }
        function irabuscar(valor){
            let buscar=$(valor).attr('data-attr')
            window.location.href=buscar
        }
</script>