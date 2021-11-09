<div class="row">
    <div class="col-10 text-center">
       <h2>Productos</h2>
    </div>
    <div class="col-2 text-center ">
    
    <button type="button" class="btn btn-outline-primary" id="addValue" data-attr="{{ route('productos-admin-modal',0) }}">Agregar</button>
    </div>
    <div class="col-12 mt-5">
        <div id="infodata">
                @include('productos.tableview')
        </div>
    </div>

</div>
<div id="Modal">
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
                        $('#userCrudModal').html('Editar Productos')
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
        $(document).on('click', '#addValue', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                        url: href,
                        type:'GET'
                    }).done(function(data){
                        $('#Modal').html(data)
                        $('#userCrudModal').html('Agregar Productos')
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