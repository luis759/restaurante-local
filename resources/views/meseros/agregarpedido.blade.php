@extends('layouts.app')

@section('content')
<div class="container">
@include('meseros.nuevopedido')

</div>

@endsection

@section('footer')
<div class="footer" style="position: fixed;bottom: 0;width: 100%;">
<div class="card w-100">
  <div class="card-body">
    <div class="row">
        <div class="col-8 m-0">
            <p class="m-0">Sub-Total: <span id="sutotalfooter"></span>$</p>
            <p class="m-0">Propina:   <span id="propinafooter"></span>$</p>
            <p class="m-0">Total:   <span id="totalfooter"></span>$</p>
        </div>
        <div class="col-4">
        <button type="button" class="btn btn-primary btn-sm btn-block">Agregar Orden</button>
        </div>
    </div>
  </div>
</div>
</div>
@endsection