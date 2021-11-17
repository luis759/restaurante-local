<div class="row">
    <div class="col-10 text-center">
       <h2>Ordenes</h2>
    </div>
    <div class="col-2 text-center ">
    
    <button type="button" class="btn btn-outline-primary" id="addValue" data-attr="{{ route('ordenes-admin-modal',0) }}">Agregar</button>
    </div>
    <div class="col-12 mt-5">
        <div id="infodata">
                @include('ordenes.tableview')
        </div>
    </div>

</div>
<div id="Modal">
</div>

<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true" data-delay="10000" style="position: absolute; top: 0; right: 0;"> 
  <div class="toast-header">
    <strong class="mr-auto">{{ config('app.name', 'Laravel') }}</strong>
    <small>Recent</small>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body" id="toastMessage">
  </div>
</div>
  <script>
      $(document).ready( function () {
        $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });


        $('#table_id').DataTable( {
                                        paging: true,
                                    });
                                    
        $(document).on('click', '#editValue', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                        url: href,
                        type:'GET'
                    }).done(function(data){
                        $('#Modal').html(data)
                        $('#userCrudModal').html('Editar Ordenes')
                    });
        });
        $(document).on('click', '#deletevalue', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                        url: href,
                        type:'DELETE'
                    }).done(function(data){
                            $('#infodata').html(data)
                            $('#Modal').html('');
                            $('#table_id').DataTable( {
                                        paging: true,
                                    });
                    });
        });
        $(document).on('click', '#pagadosSvg', function(event) {
            event.preventDefault();
            let documenot= $(this)
            let href = $(this).attr('data-attr');
            if(href){

                $.ajax({
                        url: href,
                        type:'GET'
                    }).done(function(data){
                         let valorRetorno = data
                         if(valorRetorno['success']){
                            documenot.attr('data-attr','');
                            documenot.attr("fill", "green")
                            $('#toastMessage').html(valorRetorno['message'])
                            $('.toast').toast("show")
                         }
                    });

            }
          
        });
        $(document).on('click', '#addValue', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                        url: href,
                        type:'GET'
                    }).done(function(data){
                        $('#Modal').html(data)
                        $('#userCrudModal').html('Agregar Ordenes')
                    });
        });
        $(document).on('click', '#deletevalue', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $('exampleModalLabel').html('Borrar')
            $('#mediumModal').modal("show");
        });
} );
</script>