@extends('content')
@section('title', "Gestão de Matriculas")

@section('content')

    <div>
        <div class="box box-danger">
            <div class="box-body">

                @if(isset( $matricula))
                    {!! Form::model( $matricula,['route'=>['matricula.update',  $matricula->id], 'class'=>'form form-search form-ds', 'method'=>'PUT']) !!}
                @else
                    {!! Form::open(['route'=>'matricula.store', 'class'=>'form form-search form-ds']) !!}
                @endif


                <div class="row">
                    <div class="form-group col-md-2 input-group-sm">
                        <label for="id">Código</label>
                        @if(isset($codigo))
                            {!! Form::text('codg_matr', $codigo, ['class'=> 'form-control','readonly'=>'true' ]) !!}
                        @else
                            {!! Form::text('codg_matr', null, ['class'=> 'form-control','readonly'=>'true' ]) !!}
                        @endif
                    </div>

                    <div class="form-group col-md-5 input-group-sm has-feedback {{ $errors->has('aluno_id') ? 'has-error' : '' }}">
                        <label for="aluno_id">Aluno</label>
                        {!! Form::select('aluno_id', $alunos, null, ['class'=>'form-control select2 ','placeholder' => 'Selecione']) !!}
                        <span></span>
                        @if ($errors->has('aluno_id'))
                            <span class="help-block">
                            <strong>{{ $errors->first('aluno_id') }}</strong>
                        </span>
                        @endif
                    </div>


                    <div class="form-group col-md-5 input-group-sm has-feedback {{ $errors->has('plano_id') ? 'has-error' : '' }}">
                        <label for="plano_id">Planos</label>
                        {!! Form::select('plano_id', $planos, null, ['class'=>'form-control select2','placeholder' => 'Selecione']) !!}
                        <span></span>
                        @if ($errors->has('plano_id'))
                            <span class="help-block">
                            <strong>{{ $errors->first('plano_id') }}</strong>
                        </span>
                        @endif
                    </div>


                </div>


                <div class=" box-footer">
                    <div style="float: left">
                        <a href="{{route('matricula')}}" class="btn btn-danger btn-sm"><i class="fa fa-times"></i>
                            Cancelar</a>
                    </div>
                    <div style="float: right">
                        <button type="submit" class="btn btn-primary btn-light-blue btn-sm"><i class="fa fa-check"></i>
                            Cadastrar
                        </button>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        </div>

    </div>


    <div>
        <div class="box box-danger">
            <div class="box-header">
                <h4><b>Gestão de Matriculas</b></h4>
            </div>
            <hr class="linha">
            <div class="box-body">
                <div class="table-responsive-sm">
                    {!! Form::open(['name'=> 'form_search', 'route'=>'matricula']) !!}
                    <div class="well well-sm input-group input-group-sm">
                        <input type="text" class="form-control foco" name="filtro"
                               placeholder="Informe a Matrícula,  nome do Aluno ou nome do Plano.." id="busca">
                        <span class="input-group-btn">
                            <button type="submit" name="search" class="btn btn-primary"><i
                                        class="fa fa-search"></i></button>
                        </span>
                    </div>
                    {!! Form::close() !!}
                    <table class="table table-hover table-striped table-sm ">
                        <thead>
                        <tr>
                            <th>Matrícula</th>
                            <th>Aluno</th>
                            <th>Telefone</th>
                            <th>Plano</th>
                            <th>Duração</th>
                            <th>Valor Mensal</th>
                            <th style="text-align: center">Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($matriculas as $m)
                            <tr>
                                <td>{{$m->codg_matr}}</td>
                                <td>{{$m->aluno->nome_aluno}}</td>
                                <td>{{strlen($m->aluno->telf_aluno) == 10 ? preg_replace('/(\d{2})(\d{4})(\d{4})/','($1) $2-$3',$m->aluno->telf_aluno) : preg_replace('/(\d{2})(\d{1})(\d{4})(\d{4})/','($1) $2.$3-$4',$m->aluno->telf_aluno) }}</td>
                                <td>{{$m->plano->nome_plan}}</td>
                                <td>{{$m->plano->peri_plan}} meses</td>
                                <td>{{number_format($m->plano->valr_plan,2,',','.')}}</td>
                                <td align="center">

                                    <!-- MODAL EXCLUIR -->
                                    <a title="Excluir" class="btn btn-danger btn-xs" type="button"
                                       data-toggle="modal" data-target="#id{{$m->id}}">
                                        <i class="fa fa-trash"></i> </a>

                                    <div class="modal modal-info fade" data-backdrop="static" id="id{{$m->id}}"
                                         tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="box box-danger">
                                                <div class="box-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h4 class="modal-title text-center" id="myModalLabel">
                                                        <b> Exclusão da Matricula do
                                                            Aluno: </b><br/> {{$m->aluno->nome_aluno}}
                                                    </h4>
                                                </div>
                                                <div class="box-body">
                                                    <b>As mensalidades não quitadas serão excluidas, e o aluno(a)
                                                        inativado!
                                                        <br/>
                                                        Tem certeza que deseja excluir?
                                                    </b>
                                                </div>
                                                <div class=" box-footer">

                                                    {!! Form::open(['route'=>'matricula.remove', 'class'=>'form form-search form-ds']) !!}


                                                    <div style="float: left">
                                                        <a class="btn btn-danger btn-sm" data-dismiss="modal"><i
                                                                    class="fa fa-times"></i>
                                                            Cancelar</a>
                                                    </div>
                                                    <div>
                                                        <input name="Matricula_id" type="hidden" value="{{$m->id}}">
                                                        <input name="aluno_id" type="hidden" value="{{$m->aluno_id}}">
                                                    </div>
                                                    <div style="float: right">
                                                        <button type="submit"
                                                                class="btn btn-primary btn-light-blue btn-sm"><i
                                                                    class="fa fa-check"></i>
                                                            Excluir
                                                        </button>
                                                    </div>
                                                    {!! Form::close() !!}

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
                </div>
            </div>
        </div>


    </div>


@endsection
