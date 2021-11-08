
<table id="table_id">
@if (isset($errores))
    <div class="alert alert-danger">
        <ul>
            @foreach ($errores->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <thead>
                    <tr>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Nivel</th>
                        <th class="text-center">Correo</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($DataUsuarios as $DataUsuarios)
                    <tr>
                        <td class="text-center">{{ $DataUsuarios->name }}</td>
                        <td class="text-center">{{ $DataUsuarios->nombre_nivel }}</td>
                        <td class="text-center">{{ $DataUsuarios->email }}</td>
                        <td class="text-center">
                            <svg  id="editValue" data-attr="{{ route('usuarios-admin-modal', $DataUsuarios->id) }}" width="30" height="30" fill="blue" class="bi bi-pencil-square mr-2" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>    
                            <svg  id="deletevalue" data-attr="{{ route('usuarios-admin-delete', $DataUsuarios->id) }}" width="30" height="30" fill="red" class="bi bi-x-square-fill" viewBox="0 0 16 16">
                            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                            </svg>
                        </td>
                    </tr>
                @endforeach
                  
                </tbody>
            </table>
            <script>
                    

            </script>