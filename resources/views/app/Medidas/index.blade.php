@extends('content')
@section('title', "Gestão de Medidas")

@section('content')

    <div>
        <div class="box box-danger">
            <div class="box-header">
                <h4 ><b>Gestão de Medidas</b>

                    <a href="{{route('medida.create')}}" style="float: right;" type="button"
                       class="btn btn-primary "><i class="fa fa-plus"></i> Novo </a></h4>
            </div>
            <hr class="linha">
            <div class="box-body">
                <div class="table-responsive-sm">

                    {!! Form::open(['name'=> 'form_search', 'route'=>'medida']) !!}
                    <div class="well well-sm input-group input-group-sm">
                        <input type="text" class="form-control foco" name="filtro" placeholder="Informe um ID, nome do Aluno ou nome Professor.." id="busca" >
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
                            <th>Professor</th>
                            <th>Data Coleta</th>
                            <th style="text-align: center">Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($medidas as $m)
                            <tr>
                                <td>{{$m->codg_medd}}</td>
                                <td>{{$m->nome_aluno}}</td>
                                <td>{{$m->nome_pers}}</td>
                                <td>{{formatDateAndTime($m->data_coleta, 'd/m/Y')}}</td>
                                <td align="center">

                                    <a href="{{route('medida.listaMedidas', $m->id)}}" type="button"
                                       class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" target="_blank"
                                       title="PDF"><i class="fa fa-file-pdf-o"></i></a>

                                    <a href="{{route('medida.edit', $m->id)}}" type="button"
                                       class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top"
                                       title="Editar"><i class="fa fa-edit"></i></a>

                                    <!-- MODAL EXCLUIR -->
                                    <a title="Excluir" class="btn btn-danger btn-xs" type="button"
                                       data-toggle="modal" data-target="#id{{$m->id}}">
                                        <i class="fa fa-trash"></i> </a>

                                    <div class="modal modal-info fade" data-backdrop="static" id="id{{$m->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="box box-danger">
                                                <div class="box-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h4 class="modal-title text-center" id="myModalLabel">
                                                        Exclusão das Medidas do Aluno(a): <br/> {{$m->nome_aluno}}
                                                    </h4>
                                                </div>
                                                <div class="box-body">
                                                    Tem certeza que deseja excluir?
                                                </div>
                                                <div class=" box-footer">
                                                    <form action="{{route('medida.destroy', [$m->id] )}}">
                                                        {{method_field('delete')}}

                                                        <div style="float: left">
                                                            <a class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i>
                                                                Cancelar</a>
                                                        </div>
                                                        <div style="float: right">
                                                            <button type="submit" class="btn btn-primary btn-light-blue btn-sm"><i
                                                                        class="fa fa-check"></i>
                                                                Excluir
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- MODAL EXCLUIR -->

                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="200">Não Existem Registros</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{$medidas->links()}}
                </div>
            </div>
        </div>

    </div>

@endsection
