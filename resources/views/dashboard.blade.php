@extends('layouts.app')

@section('content')
<div class="container">
                            
            <h1 class="text-center">ORDENES </H1>
            <div class="row mb-4 justify-content-end">
                <form class="form-inline " style="display: flex; justify-content: flex-end">
                    <div class="form-group mb-2">
                        <p>Fecha</p>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                    <input size="16" type="text" class="form-control" id="datetime" readonly>
                    </div>
                    <button type="button" class="btn btn-primary px-3 mb-2" onclick="buscar()">
                    <svg width="25" height="25" fill="black"  viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </button>
                    </form>
            </div>
            <div id="dashboardventas">
                                       @include('admin.dashboard.ventas')
            </div>
</div>

<script>
    
    $(document).ready( function () { 

        $('#datetime').datepicker({
	format: 'yyyy-mm-dd',
});
    })

  function buscar(){
    $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        let datas={
            fecha:$('#datetime').val()
        }
                $.ajax({ 
                    type: "POST",
                    url: "{{route('dashboard-admin-fechaget')}}", 
                    data: datas,
                        }).done(function(data){
                            if(data['success']){
                             $('#dashboardventas').html('')
                             $('#dashboardventas').html(data['dashboard'])
                            }
                        });
  }
</script>  
@endsection
