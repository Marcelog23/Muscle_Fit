@extends('content')
@section('title', "Gestão de Exercicios")

@section('content')

    <div>
        <div class="box">
            <div class="box-header">
                <h4><b>Manutenção de Exercícios</b></h4>
            </div>
            <hr class="linha">
            <div class="box-body">


                @if(isset( $exercicio))
                    {!! Form::model( $exercicio,['route'=>['exercicio.update',  $exercicio->id], 'class'=>'form form-search form-ds', 'method'=>'PUT']) !!}
                @else
                    {!! Form::open(['route'=>'exercicio.store', 'class'=>'form form-search form-ds']) !!}
                @endif


                <div class="row">
                    <div class="form-group col-md-2 input-group-sm">
                        <label for="id">Código</label>
                        @if(isset($codigo))
                            {!! Form::text('codg_exrc', $codigo, ['class'=> 'form-control','readonly'=>'true' ]) !!}
                        @else
                            {!! Form::text('codg_exrc', null, ['class'=> 'form-control','readonly'=>'true' ]) !!}
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12 input-group-sm has-feedback {{ $errors->has('nome_exrc') ? 'has-error' : '' }}">
                        <label for="nome_exrc">Nome Exercício</label>
                        {!! Form::text('nome_exrc',  null, ['class'=>'form-control foco','onkeyup'=>'value=value.toUpperCase()']) !!}
                        @if ($errors->has('nome_exrc'))
                            <span class="help-block">
                    <strong>{{ $errors->first('nome_exrc') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class=" box-footer">
                    <div style="float: left">
                        <a href="{{route('exercicio')}}" class="btn btn-danger btn-sm"><i class="fa fa-times"></i>
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
