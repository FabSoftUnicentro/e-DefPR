@extends('adminlte::page')

@section('title', '404 Página não encontrada')

@section('content')
    <div class="error-page">
        <h2 class="headline text-red">500</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-red"></i> Oops! Algo deu errado.</h3>

            <p>
                Vamos trabalhar para consertar isso imediatamente.
            </p>

            <p>
                @auth
                    Você pode retornar ao <a href="{{ route('dashboard') }}">dashboard</a>.
                @endauth

                @guest
                   Você pode fazer <a href="{{ route('login') }}">login</a>.
                @endguest
            </p>
        </div>
        <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
@stop