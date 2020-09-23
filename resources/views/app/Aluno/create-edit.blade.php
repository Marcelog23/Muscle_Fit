@extends('content')
@section('title', "Manutenção de Alunos")

@section('content')

    <div>
        <div class="box box-danger">
            <div class="box-header">
                <h4><b>Manutenção de Alunos</b></h4>
            </div>
            <hr class="linha">
            <div class="box-body">


                @if(isset($aluno))
                    {!! Form::model($aluno,['route'=>['aluno.update', $aluno->id], 'class'=>'form form-search form-ds', 'method'=>'PUT','id'=>'form']) !!}
                @else
                    {!! Form::open(['route'=>'aluno.store', 'class'=>'form form-search form-ds','id'=>'form']) !!}
                @endif


                <div class="row">
                    <div class="form-group col-md-2 input-group-sm">
                        <label for="id">Código</label>
                        @if(isset($codigo))
                            {!! Form::text('codg_aluno', $codigo, ['class'=> 'form-control','readonly'=>'true' ]) !!}
                        @else
                            {!! Form::text('codg_aluno', null, ['class'=> 'form-control','readonly'=>'true' ]) !!}
                        @endif
                    </div>


                    <div class="form-group col-md-2 input-group-sm has-feedback {{ $errors->has('genr_aluno') ? 'has-error' : '' }}">
                        <label for="genr_aluno">Genero</label>
                        {!! Form::select('genr_aluno', $genero, null, ['class'=>'form-control foco']) !!}
                        <span></span>
                        @if ($errors->has('genr_aluno'))
                            <span class="help-block">
                            <strong>{{ $errors->first('genr_aluno') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group col-md-2 input-group-sm has-feedback {{ $errors->has('data_nasc') ? 'has-error' : '' }}">
                        <label for="data_nasc">Data Nascimento</label>
                        {!! Form::date('data_nasc', null, ['class'=>'form-control']) !!}
                        <span></span>
                        @if ($errors->has('data_nasc'))
                            <span class="help-block">
                            <strong>{{ $errors->first('data_nasc') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12 input-group-sm has-feedback {{ $errors->has('nome_aluno') ? 'has-error' : '' }}">
                        <label for="nome_aluno">Nome</label>
                        {!! Form::text('nome_aluno', null, ['class'=>'form-control','onkeyup'=>'value=value.toUpperCase()']) !!}
                        <span></span>
                        @if ($errors->has('nome_aluno'))
                            <span class="help-block">
                            <strong>{{ $errors->first('nome_aluno') }}</strong>
                        </span>
                        @endif
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-8 input-group-sm has-feedback {{ $errors->has('endr_aluno') ? 'has-error' : '' }}">
                        <label for="endr_aluno">Endereço</label>
                        {!! Form::text('endr_aluno', null,['class'=>'form-control','onkeyup'=>'value=value.toUpperCase()']) !!}
                        <span></span>
                        @if ($errors->has('endr_aluno'))
                            <span class="help-block">
                            <strong>{{ $errors->first('endr_aluno') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group col-md-2 input-group-sm has-feedback {{ $errors->has('numr_endr') ? 'has-error' : '' }}">
                        <label for="numr_endr">Número</label>
                        {!! Form::text('numr_endr', null,['class'=>'form-control']) !!}
                        <span></span>
                        @if ($errors->has('numr_endr'))
                            <span class="help-block">
                            <strong>{{ $errors->first('numr_endr') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group col-md-2 input-group-sm has-feedback {{ $errors->has('cep_aluno') ? 'has-error' : '' }}">
                        <label for="cep_acade">Cep</label>
                        {!! Form::text('cep_aluno',null,['class'=>'form-control cep']) !!}
                        <span></span>
                        @if ($errors->has('cep_aluno'))
                            <span class="help-block">
                            <strong>{{ $errors->first('cep_aluno') }}</strong>
                        </span>
                        @endif
                    </div>


                </div>

                <div class="row">
                    <div class="form-group col-md-6 input-group-sm has-feedback {{ $errors->has('cidade_id') ? 'has-error' : '' }}">
                        <label for="cidade_id">Cidade</label>
                        {!! Form::select('cidade_id', $cidades, null, ['class'=> 'form-control select2']) !!}
                        <span></span>
                        @if ($errors->has('cidade_id'))
                            <span class="help-block">
                            <strong>{{ $errors->first('cidade_id') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group col-md-2 input-group-sm has-feedback {{ $errors->has('telf_aluno') ? 'has-error' : '' }}">
                        <label for="telf_aluno">Telefone</label>
                        {!! Form::text('telf_aluno', null,['class'=>'form-control phone']) !!}
                        <span></span>
                        @if ($errors->has('telf_aluno'))
                            <span class="help-block">
                            <strong>{{ $errors->first('telf_aluno') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group col-md-4 input-group-sm has-feedback {{ $errors->has('email_aluno') ? 'has-error' : '' }}">
                        <label for="email_aluno">E-mail</label>
                        {!! Form::email('email_aluno', null,['class'=>'form-control email']) !!}
                        <span></span>
                        @if ($errors->has('email_aluno'))
                            <span class="help-block">
                            <strong>{{ $errors->first('email_aluno') }}</strong>
                        </span>
                        @endif
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-6 input-group-sm has-feedback {{ $errors->has('cpf_aluno') ? 'has-error' : '' }}">
                        <label for="cpf_aluno">CPF</label>
                        {!! Form::text('cpf_aluno',null,['class'=>'form-control cpf']) !!}
                        <span></span>
                        @if ($errors->has('cpf_aluno'))
                            <span class="help-block">
                            <strong>{{ $errors->first('cpf_aluno') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6 input-group-sm has-feedback {{ $errors->has('rg_aluno') ? 'has-error' : '' }}">
                        <label for="rg_aluno">Identidade</label>
                        {!! Form::text('rg_aluno',null,['class'=>'form-control ident']) !!}
                        <span></span>
                        @if ($errors->has('rg_aluno'))
                            <span class="help-block">
                            <strong>{{ $errors->first('rg_aluno') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4 input-group-sm has-feedback {{ $errors->has('leso_aluno') ? 'has-error' : '' }}">
                        <label for="leso_aluno">Lesões</label>
                        {!! Form::textarea('leso_aluno',null,['class'=>'form-control','rows'=>'6','onkeyup'=>'value=value.toUpperCase()']) !!}
                        <span></span>
                        @if ($errors->has('leso_aluno'))
                            <span class="help-block">
                            <strong>{{ $errors->first('leso_aluno') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4 input-group-sm has-feedback {{ $errors->has('remd_aluno') ? 'has-error' : '' }}">
                        <label for="remd_aluno">Remédios</label>
                        {!! Form::textarea('remd_aluno',null,['class'=>'form-control','rows'=>'6','onkeyup'=>'value=value.toUpperCase()']) !!}
                        <span></span>
                        @if ($errors->has('remd_aluno'))
                            <span class="help-block">
                            <strong>{{ $errors->first('remd_aluno') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group col-md-4 input-group-sm has-feedback {{ $errors->has('objt_aluno') ? 'has-error' : '' }}">
                        <label for="objt_aluno">Objetivo</label>
                        {!! Form::textarea('objt_aluno',null,['class'=>'form-control','rows'=>'6','onkeyup'=>'value=value.toUpperCase()']) !!}
                        <span></span>
                        @if ($errors->has('objt_aluno'))
                            <span class="help-block">
                            <strong>{{ $errors->first('objt_aluno') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>




                <div class=" box-footer">
                    <div style="float: left">
                        <a href="{{route('aluno')}}" class="btn btn-danger btn-sm "><i class="fa fa-times"></i>
                            Cancelar</a>
                    </div>
                    <div style="float: right">
                        <button type="submit" class="btn btn-primary btn-light-blue btn-sm"><i class="fa fa-check"></i>
                            Confirmar
                        </button>
                    </div>
                </div>


            </div>

            {!! Form::close() !!}
        </div>


    </div>

@endsection

@section('js')


@endsection