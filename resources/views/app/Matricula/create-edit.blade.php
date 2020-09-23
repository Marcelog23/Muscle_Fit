@extends('content')
@section('title', "Manutenção de Matrículas")

@section('content')

    <div>
        <div class="box box-danger">
            <div class="box-header">
                <h4><b>Manutenção de Matrículas</b></h4>
            </div>
            <hr class="linha">
            <div class="box-body">

                @if(isset($errors) && $errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </ul>
                    </div>
                @endif
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
                </div>

                 <div class="row">
                     <div class="form-group col-md-6 input-group-sm">
                         <label for="aluno_id">Aluno</label>
                         {!! Form::select('aluno_id', $alunos, null, ['class'=>'form-control select2 foco','placeholder' => 'Selecione']) !!}
                     </div>
                     <div class="form-group col-md-6 input-group-sm">
                         <label for="plano_id">Planos</label>
                         {!! Form::select('plano_id', $planos, null, ['class'=>'form-control select2','placeholder' => 'Selecione']) !!}
                     </div>
                 </div>


                <div class=" box-footer">
                    <div style="float: left">
                        <a href="{{route('matricula')}}" class="btn btn-danger btn-sm"><i class="fa fa-times"></i>
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
