@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><b>Listado de Permisos</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Permisos Registrados</h3>
                    <div class="card-tools">
                        <a href="{{url('/admin/permisos/reporte')}}" target="_blank" class="btn btn-danger"><i class="fa fa-file-pdf"> Crear nuevo</i></a>
                        <a href="{{url('/admin/permisos/create')}}" class="btn btn-primary"><i class="fa fa-plus"> Crear nuevo</i></a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="miTabla" class="table table-striped table-hover table-sm">
                        <thead>
                            <tr>
                              <th scope="col" style="text-align: center">Nro</th>
                              <th scope="col">Nombre de Permiso</th>
                              <th scope="col" style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $contador = 1;?>
                        @foreach ($permisos as $permiso)
                            <tr>
                                <td style="text-align: center">{{$contador++}}</td>
                                {{-- <td style="text-align: center">{{$permiso->id}}</td> --}}
                                <td>{{$permiso->name}}</td>
                                <td style="text-align: center">
                                    <div class="btn-group" permiso="group" aria-label="Basic example">
                                        <a href="{{url('/admin/permisos', $permiso->id)}}" type="button" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                        <a href="{{url('/admin/permisos/'.$permiso->id.'/edit')}}" type="button" class="btn btn-success btn-sm"><i class="fas fa-pencil"></i></a>
                                        <form action="{{url('/admin/permisos',$permiso->id)}}" method="POST" onclick="preguntar{{$permiso->id}}(event)" id='miFormulario{{$permiso->id}}'>
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <script>
                                            function preguntar{{$permiso->id}} (event) {
                                                event.preventDefault() ;
                                                Swal.fire({
                                                    title: '¿Desea eliminar esta registro?',
                                                    text: '',
                                                    icon: 'question',
                                                    showDenyButton: true,
                                                    confirmButtonText: 'Eliminar',
                                                    confirmButtonColor: '#a5161d' ,
                                                    denyButtonColor: '#270a0a',
                                                    denyButtonText: 'Cancelar',
                                                }).then ((result) => {
                                                    if(result.isConfirmed) {
                                                        var form = $('#miFormulario{{$permiso->id}}');
                                                        form.submit ();
                                                    }
                                                });
                                            }
                                        </script>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
<script>
    $('#miTabla').DataTable({
        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ Permisos",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
</script>
@stop