@extends('layouts.app')

@section('content')
<div class="container">
@include('meseros.buscador')

@include('meseros.nuevopedido')


@include('resourcestoast.toast')
@endsection

@section('footer')
<div class="footer" style="position: sticky;bottom: 0;width: 100%; z-index:10;">
<div class="card w-100">
  <div class="card-body">
    <div class="row">
        <div class="col-12 m-0">
        <div class="form-group row">
                                <label for="cantidad"   class="col-sm-2 col-form-label">Observacion :</label>
                                <div class="col-sm-10">
                                @if(!isset($dataOrdenes))
                                <input type="text" min="0" class="form-control"  id="observaciones" placeholder="" value=''>
                                @else
                                <input type="text" min="0" class="form-control"  id="observaciones" placeholder="" value='{{$dataOrdenes->observaciones}}'>
                              @endif 
                              </div>
        </div>
        </div>
        <div class="col-8 m-0">
            <p class="m-0">Sub-Total: <span id="sutotalfooter"></span>$</p>
            <p class="m-0">Propina:   <span id="propinafooter"></span>$</p>
            <p class="m-0">Total:   <span id="totalfooter"></span>$</p>
        </div>
        <div class="col-4">
        @if(isset($dataOrdenes))

        <button type="button" class="btn btn-primary btn-sm btn-block" onclick="clickEditar()"> Editar Orden</button>

        @else
        <button type="button" class="btn btn-primary btn-sm btn-block" onclick="clickbotonmodal()"> Agregar Orden</button>
        @endif
        </div>
    </div>
  </div>
</div>
</div>
</div>
@endsection