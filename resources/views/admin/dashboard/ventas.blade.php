     <!-- Content Row -->
     <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Ganancia Propina</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{$OrdenesTotalPropina->total?$OrdenesTotalPropina->total:0}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Ganancia ventas (SIN DELIVERY)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{$OrdenesTotalSinDelivery->total?$OrdenesTotalSinDelivery->total:0}} </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <!-- Earnings (Monthly) Card Example -->
             <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Ganancia ventas (CON DELIVERY)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{$OrdenesTotalDelivery->total?$OrdenesTotalDelivery->total:0}}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Ordenes Abiertas sin pagar (Todas)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{$OrdenesTotalSinpagar->total?$OrdenesTotalSinpagar->total:0}}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h4 class="text-center">Total de Meseros (PAGADOS)</h4>
        <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Correo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Propina (Total)</th>
                    <th scope="col">Vendido (Total)</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($VentasTotalPorMesero as $VentasTotalPorMeseros)
                    <tr>
                    <th scope="row"> {{$VentasTotalPorMeseros->email}}</th>
                    <td>{{$VentasTotalPorMeseros->name}}</td>
                    <td>$ {{$VentasTotalPorMeseros->totalpropina}}</td>
                    <td>$ {{$VentasTotalPorMeseros->total}}</td>
                    </tr>
                @endforeach
                </tbody>
        </table>
        </div> 
    </div>