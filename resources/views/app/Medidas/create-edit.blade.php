@extends('content')
@section('title', "Manutenção de Medidas")

@section('content')

    <div>
        <div class="box box-danger">
            <div class="box-header">
                <h4><b>Manutenção de Medidas</b></h4>
            </div>
            <hr class="linha">
            <div class="box-body">


                @if(isset($medidas))
                    {!! Form::model($medidas,['route'=>['medida.update', $medidas->id], 'class'=>'form form-search form-ds', 'method'=>'PUT']) !!}
                @else
                    {!! Form::open(['route'=>'medida.store', 'class'=>'form form-search form-ds']) !!}
                @endif


                <div class="row">
                    <div class="form-group col-md-2 input-group-sm">
                        <label for="id">Código</label>
                        @if(isset($codigo))
                            {!! Form::text('codg_medd', $codigo, ['class'=> 'form-control','readonly'=>'true' ]) !!}
                        @else
                            {!! Form::text('codg_medd', null, ['class'=> 'form-control','readonly'=>'true' ]) !!}
                        @endif
                    </div>


                    <div class="form-group col-md-2 input-group-sm has-feedback {{ $errors->has('data_nasc') ? 'has-error' : '' }}">
                        <label for="data_nasc">Data Coleta</label>
                        {!! Form::date('data_coleta', \Carbon\Carbon::now(), ['class'=>'form-control']) !!}
                        @if ($errors->has('data_nasc'))
                            <span class="help-block">
                    <strong>{{ $errors->first('data_nasc') }}</strong>
                        </span>
                        @endif
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-6 input-group-sm has-feedback {{ $errors->has('matricula_id') ? 'has-error' : '' }}">
                        <div style="width: 100%;">
                        <label for="matricula_id">Matricula/Aluno</label>
                        {!! Form::select('matricula_id', $matricula, null, ['class'=>'form-control select2 foco','placeholder' => 'Selecione']) !!}
                        @if ($errors->has('matricula_id'))
                            <span class="help-block">
                            <strong>
                                {{ $errors->first('matricula_id') }}
                            </strong>
                            </span>
                        @endif
                        </div>
                    </div>

                    <div class="form-group col-md-6 input-group-sm has-feedback {{ $errors->has('personal_id') ? 'has-error' : '' }}">
                        <div style="width: 100%;">
                        <label for="personal_id">Personal</label>
                        {!! Form::select('personal_id', $personal, null, ['class'=>'form-control select2','placeholder' => 'Selecione']) !!}
                        @if ($errors->has('personal_id'))
                            <span class="help-block">
                    <strong>{{ $errors->first('personal_id') }}</strong>
                        </span>
                        @endif
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="form-group col-md-2 input-group-sm has-feedback {{ $errors->has('peso_aluno') ? 'has-error' : '' }}">
                        <label for="peso_aluno">Peso</label>
                        {!! Form::number('peso_aluno', null, ['class'=>'form-control', 'id'=>'peso_aluno']) !!}
                        @if ($errors->has('name'))
                            <span class="help-block">
                    <strong>{{ $errors->first('peso_aluno') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-2 input-group-sm has-feedback {{ $errors->has('altr_aluno') ? 'has-error' : '' }}">
                        <label for="altr_aluno">Altura</label>
                        {!! Form::number('altr_aluno', null, ['class'=>'form-control']) !!}
                        @if ($errors->has('altr_aluno'))
                            <span class="help-block">
                    <strong>{{ $errors->first('altr_aluno') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-2 input-group-sm has-feedback {{ $errors->has('cint_aluno') ? 'has-error' : '' }}">
                        <label for="cint_aluno">Cintura</label>
                        {!! Form::number('cint_aluno', null, ['class'=>'form-control']) !!}
                        @if ($errors->has('cint_aluno'))
                            <span class="help-block">
                        <strong>
                        {{ $errors->first('cint_aluno') }}
                        </strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-2 input-group-sm has-feedback {{ $errors->has('qudr_aluno') ? 'has-error' : '' }}">
                        <label for="qudr_aluno">Quadril</label>
                        {!! Form::number('qudr_aluno', null, ['class'=>'form-control']) !!}
                        @if ($errors->has('qudr_aluno'))
                            <span class="help-block">
                        <strong>
                        {{ $errors->first('qudr_aluno') }}
                        </strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group col-md-2 input-group-sm has-feedback {{ $errors->has('abdm_aluno') ? 'has-error' : '' }}">
                        <label for="abdm_aluno">Abdomen</label>
                        {!! Form::number('abdm_aluno', null, ['class'=>'form-control']) !!}
                        @if ($errors->has('abdm_aluno'))
                            <span class="help-block">
                        <strong>
                        {{ $errors->first('abdm_aluno') }}
                        </strong>
                        </span>
                        @endif
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-2 input-group-sm">
                    </div>
                    <div class="form-group col-md-2 input-group-sm has-feedback {{ $errors->has('bicp_dirt') ? 'has-error' : '' }}">
                        <label for="bicp_dirt">Bícips Direito</label>
                        {!! Form::number('bicp_dirt', null, ['class'=>'form-control']) !!}
                        @if ($errors->has('bicp_dirt'))
                            <span class="help-block">
                        <strong>
                        {{ $errors->first('bicp_dirt') }}
                        </strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-2 input-group-sm has-feedback {{ $errors->has('bicp_esqr') ? 'has-error' : '' }}">
                        <label for="bicp_esqr">Bícips Esquerdo</label>
                        {!! Form::number('bicp_esqr', null, ['class'=>'form-control']) !!}
                        @if ($errors->has('bicp_esqr'))
                            <span class="help-block">
                        <strong>
                        {{ $errors->first('bicp_esqr') }}
                        </strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-2 input-group-sm has-feedback {{ $errors->has('ante_brco_dirt') ? 'has-error' : '' }}">
                        <label for="ante_brco_dirt">Ante Braço Dir.</label>
                        {!! Form::number('ante_brco_dirt', null, ['class'=>'form-control']) !!}
                        @if ($errors->has('ante_brco_dirt'))
                            <span class="help-block">
                        <strong>
                        {{ $errors->first('ante_brco_dirt') }}
                        </strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-2 input-group-sm has-feedback {{ $errors->has('ante_brco_esqr') ? 'has-error' : '' }}">
                        <label for="ante_brco_esqr">Ante Braço Esq.</label>
                        {!! Form::number('ante_brco_esqr', null, ['class'=>'form-control']) !!}
                        @if ($errors->has('ante_brco_esqr'))
                            <span class="help-block">
                        <strong>
                        {{ $errors->first('ante_brco_esqr') }}
                        </strong>
                        </span>
                        @endif
                    </div>
                </div>

                 <div class="row">
                     <div class="form-group col-md-2 input-group-sm">
                     </div>
                     <div class="form-group col-md-2 input-group-sm has-feedback {{ $errors->has('coxa_esqr') ? 'has-error' : '' }}">
                         <label for="coxa_esqr">Coxa Esquerda</label>
                         {!! Form::number('coxa_esqr', null, ['class'=>'form-control']) !!}
                         @if ($errors->has('coxa_esqr'))
                             <span class="help-block">
                        <strong>
                        {{ $errors->first('coxa_esqr') }}
                        </strong>
                        </span>
                         @endif
                     </div>
                     <div class="form-group col-md-2 input-group-sm has-feedback {{ $errors->has('coxa_dirt') ? 'has-error' : '' }}">
                         <label for="coxa_dirt">Coxa Direita</label>
                         {!! Form::number('coxa_dirt', null, ['class'=>'form-control']) !!}
                         @if ($errors->has('coxa_dirt'))
                             <span class="help-block">
                        <strong>
                        {{ $errors->first('coxa_dirt') }}
                        </strong>
                        </span>
                         @endif
                     </div>
                     <div class="form-group col-md-2 input-group-sm has-feedback {{ $errors->has('pantr_esqr') ? 'has-error' : '' }}">
                         <label for="pantr_esqr">Panturrilha Esquerda</label>
                         {!! Form::number('pantr_esqr', null, ['class'=>'form-control']) !!}
                         @if ($errors->has('pantr_esqr'))
                             <span class="help-block">
                        <strong>
                        {{ $errors->first('pantr_esqr') }}
                        </strong>
                        </span>
                         @endif
                     </div>
                     <div class="form-group col-md-2 input-group-sm has-feedback {{ $errors->has('pantr_dirt') ? 'has-error' : '' }}">
                         <label for="pantr_dirt">Panturrilha Direita</label>
                         {!! Form::number('pantr_dirt', null, ['class'=>'form-control']) !!}
                         @if ($errors->has('pantr_dirt'))
                             <span class="help-block">
                        <strong>
                        {{ $errors->first('pantr_dirt') }}
                        </strong>
                        </span>
                         @endif
                     </div>
                 </div>




                <div class=" box-footer ">
                    <div style="float: left">
                        <a href="{{route('medida')}}" class="btn btn-danger btn-sm"><i class="fa fa-times"></i>
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
