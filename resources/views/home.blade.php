@extends('layouts.app')

@section('content')
<div class="container">
                                        @if(Auth::guard('admin')->check())

                                                @include('admin.contenido')

                                        @elseif(Auth::guard('mesero')->check())

                                        @endif
</div>
@endsection
