
<div class="row">
    <div class="col-10 text-center">
       <h2>Mesas</h2>
    </div>
    <div class="col-2 text-center ">
    
    <button type="button" class="btn btn-outline-primary" id="addValue" data-attr="{{ route('mesas-admin-modal',0) }}">Agregar</button>
    </div>
    <div class="col-12 mt-5">
                @include('mesas.tableview')
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
                        $('#userCrudModal').html('Editar Mesa')
                    });
        });
        $(document).on('click', '#deletevalue', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                        url: href,
                        type:'DELETE'
                    }).done(function(data){
                       
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
                        $('#userCrudModal').html('Agregar Mesa')
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