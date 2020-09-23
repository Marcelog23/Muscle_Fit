@extends('content')
@section('title', "Manutenção do Treinos")

@section('content')

    <div>
        <div class="box box-danger">
            <div class="box-header">
                <h4><b>Gestão de Treinos</b>

                    <a href="{{route('treino.create')}}" style="float: right;" type="button"
                       class="btn btn-primary "><i class="fa fa-plus"></i> Novo </a></h4>
            </div>
            <hr class="linha">

            <div class="box-body">
                <div class="table-responsive-sm">
                    {!! Form::open(['name'=> 'form_search', 'route'=>'treino.index']) !!}
                    <div class="well well-sm input-group input-group-sm">
                        <input type="text" class="form-control foco" name="filtro" placeholder="Informe o ID ou nome do Aluno.." id="busca" >
                        <span class="input-group-btn">
                            <button type="submit" name="search" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                    {!! Form::close() !!}
                    <table class="table table-hover table-striped table-sm ">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Aluno</th>
                            <th style="text-align: right">PDF</th>
                            <th>Visualizar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($treinos as $t)
                            <tr>
                                <td>{{$t->matricula_id}}</td>
                                <td>{{$t->nome_aluno}}</td>
                                <td style="text-align: right" >

                                    <a href="{{route('treino.listaTreino',   $t->matricula_id)}}" type="button"
                                       class="btn btn-warning btn-xs"
                                       data-toggle="tooltip" data-placement="top" target="_blank"  title="PDF"><i
                                                class="fa fa-file-pdf-o"></i> PDF</a>
                                </td>
                                <td>
                                    <a href="{{route('treino.show',   $t->matricula_id)}}" type="button"
                                       class="btn btn-primary btn-xs"
                                       data-toggle="tooltip" data-placement="top" title="Visualizar"><i
                                                class="fa fa-search"></i> Visualizar</a>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="200">Não Existem Registros</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>


@endsection
