@extends('layouts.app')

@section('content')
<div class="container">
                                        @if(Auth::guard('admin')->check())

                                                @include('ordenes.contenido')

                                        @endif
</div>
@endsection