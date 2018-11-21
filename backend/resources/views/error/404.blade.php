@extends('adminlte::page')

@section('title', '404 Página não encontrada')

@section('content')
    <div class="error-page">
        <h2 class="headline text-yellow">404</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Página não encontrada.</h3>

            <p>
                Não foi possível encontrar a página que você estava procurando.
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