@extends('layouts.app')

@section('content')
<div class="container">
                                        @if(Auth::guard('admin')->check())

                                                @include('usuarios.contenido')

                                        @endif
</div>
@endsection