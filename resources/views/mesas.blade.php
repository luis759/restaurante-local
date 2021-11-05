@extends('layouts.app')

@section('content')
<div class="container">
                                        @if(Auth::guard('admin')->check())

                                                @include('mesas.contenido')

                                        @endif
</div>
@endsection
