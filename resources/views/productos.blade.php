@extends('layouts.app')

@section('content')
<div class="container">
                                        @if(Auth::guard('admin')->check())

                                                @include('productos.contenido')

                                        @endif
</div>
@endsection