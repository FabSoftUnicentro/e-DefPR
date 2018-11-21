@extends('adminlte::page')

@section('title', 'Funcionários')

@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.proto.min.js">
@endsection

@section('content_header')
    @include('helpers.flash-message')
    <h1>Funcionários cadastrados</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <div class="pull-right">
                <a class="btn btn-xs btn-primary" href="{{ route('users.create') }}">Cadastrar funcionario</a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Nome</th>
                        <th class="text-center">CPF</th>
                        <th class="text-center">RG</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="text-center">
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->cpf }}</td>
                            <td>{{ $user->rg }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('users.show', $user->id) }}">
                                    Visualizar
                                </a>
                                <a class="btn btn-xs btn-warning" href="{{ route('users.edit', $user->id) }}">
                                    Editar
                                </a>
                                <a class="btn btn-xs btn-danger user-destroy" data-id="{{ $user->id }}">
                                    Excluir
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix text-center">
            {{ $users->links() }}
        </div>
    </div>


@stop

@section('js')
    <script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('.user-destroy').on('click', function () {
            var userId = $(this).data('id');

            swal("Confirma a exclusão do funcionário?", {
                buttons: {
                    cancel: "Cancelar",
                    catch: {
                        text: "Confirmar",
                        value: "confirm",
                    },
                },
            })
            .then((value) => {
                switch (value) {
                    case "confirm":
                        $.ajax({
                            url: '{{ route('users.destroy', '_user') }}'.replace('_user', userId),
                            method: 'DELETE',
                            success: function (xhr) {
                                swal("Sucesso!", "Funcionário deletado", "success");
                            },
                            error: function (xhr) {
                                swal("Falha!", "Funcionário não pôde ser excluído", "error");
                            }
                        });
                        break;
                    default:
                        swal("Operação cancelada!");
                }
            });
        })
    </script>
@endsection