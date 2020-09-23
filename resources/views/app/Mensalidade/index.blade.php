@extends('content')
@section('title', "Gestão de Mensalidades")

@section('content')

    <div>
        <div class="box box-danger">
            <div class="box-header">
                <h4 ><b>Gestão de Mensalidades</b></h4>
            </div>

            <hr class="linha">

            <div class="box-body">
                <div class="table-responsive-sm">

                    {!! Form::open(['name'=> 'form_search', 'route'=>'mensalidade']) !!}
                        <div class="well well-sm input-group input-group-sm">
                            <input type="text" class="form-control foco" name="filtro" placeholder="Informe um ID ou Nome.." id="busca" >
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
                            <th>Plano</th>
                            <th>Visualizar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($mensalidades as $m)
                            <tr>
                                <td>{{$m->codg_mensa}}</td>
                                <td>{{$m->nome_aluno}}</td>
                                <td>{{$m->nome_plan}}</td>
                                <td> <a href="{{route('mensalidade.show', $m->codg_mensa)}}" type="button"
                                        class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top"
                                        title="Visualizar"><i class="fa fa-search"></i> Visualizar</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="200">Não Existem Registros</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{$mensalidades->links()}}
                </div>
            </div>
        </div>

    </div>


@endsection
