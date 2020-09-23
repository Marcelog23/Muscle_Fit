@extends('content')
@section('title', "Manutenção da Academia")

@section('content')

  <div>
    <div class="box box-danger">
      <div class="box-header">
        <h4><b>Manutenção da Academia</b></h4>
      </div>
      <hr class="linha">
      <div class="box-body">


        @if(isset($academia))
          {!! Form::model($academia,['route'=>['academia.update', $academia->id], 'class'=>'form form-search form-ds', 'method'=>'PUT']) !!}
        @else
          {!! Form::open(['route'=>'academia.store', 'class'=>'form form-search form-ds']) !!}
        @endif

        <div class="row">
          <div class="form-group col-md-2 input-group-sm ">
            <label for="id">Código</label>
            {!! Form::text('id', null, ['class'=> 'form-control','readonly'=>'true' ]) !!}
          </div>
          <div class="form-group col-md-10 input-group-sm has-feedback {{ $errors->has('razao_social') ? 'has-error' : '' }}">
            <label for="razao_social">Razão Social</label>
            {!! Form::text('razao_social', null, ['class'=>'form-control foco']) !!}
            @if ($errors->has('razao_social'))
              <span class="help-block">
                            <strong>{{ $errors->first('razao_social') }}</strong>
                        </span>
            @endif
          </div>
        </div>

        <div class="row">
          <div
            class="form-group col-md-12 input-group-sm has-feedback {{ $errors->has('nome_fant') ? 'has-error' : '' }}">
            <label for="nome_fant">Nome Fantasia</label>
            {!! Form::text('nome_fant', null, ['class'=>'form-control']) !!}
            @if ($errors->has('nome_fant'))
              <span class="help-block">
                            <strong>{{ $errors->first('nome_fant') }}</strong>
                        </span>
            @endif
          </div>
        </div>

        <div class="row">
          <div
            class="form-group col-md-6 input-group-sm has-feedback {{ $errors->has('endr_acade') ? 'has-error' : '' }}">
            <label for="endr_acade">Enderço</label>
            {!! Form::text('endr_acade', null,['class'=>'form-control']) !!}
            @if ($errors->has('endr_acade'))
              <span class="help-block">
                            <strong>{{ $errors->first('endr_acade') }}</strong>
                        </span>
            @endif
          </div>
          <div
            class="form-group col-md-4 input-group-sm has-feedback {{ $errors->has('compl_endr') ? 'has-error' : '' }}">
            <label for="compl_endr">Compl. Enderço</label>
            {!! Form::text('compl_endr', null,['class'=>'form-control']) !!}
            @if ($errors->has('compl_endr'))
              <span class="help-block">
                            <strong>{{ $errors->first('compl_endr') }}</strong>
                        </span>
            @endif
          </div>
          <div
            class="form-group col-md-2 input-group-sm has-feedback {{ $errors->has('numr_acade') ? 'has-error' : '' }}">
            <label for="numr_acade">Número</label>
            {!! Form::text('numr_acade', null,['class'=>'form-control']) !!}
            @if ($errors->has('numr_acade'))
              <span class="help-block">
                            <strong>{{ $errors->first('numr_acade') }}</strong>
                        </span>
            @endif
          </div>
        </div>

        <div class="row">
          <div
            class="form-group col-md-4 input-group-sm has-feedback {{ $errors->has('telf_acade') ? 'has-error' : '' }}">
            <label for="telf_acade">Telefone</label>
            {!! Form::text('telf_acade', null,['class'=>'form-control phone']) !!}
            @if ($errors->has('telf_acade'))
              <span class="help-block">
                            <strong>{{ $errors->first('telf_acade') }}</strong>
                        </span>
            @endif
          </div>
          <div
            class="form-group col-md-4 input-group-sm has-feedback {{ $errors->has('email_acade') ? 'has-error' : '' }}">
            <label for="email_acade">E-mail</label>
            {!! Form::text('email_acade', null,['class'=>'form-control email']) !!}
            @if ($errors->has('email_acade'))
              <span class="help-block">
                            <strong>{{ $errors->first('email_acade') }}</strong>
                        </span>
            @endif
          </div>
          <div
            class="form-group col-md-4 input-group-sm has-feedback {{ $errors->has('cnpj_acade') ? 'has-error' : '' }}">
            <label for="cnpj_acade">CNPJ</label>
            {!! Form::text('cnpj_acade', null,['class'=>'form-control cnpj']) !!}
            @if ($errors->has('cnpj_acade'))
              <span class="help-block">
                            <strong>{{ $errors->first('cnpj_acade') }}</strong>
                        </span>
            @endif
          </div>

        </div>

        <div class="row">
          <div
            class="form-group col-md-6 input-group-sm has-feedback {{ $errors->has('cep_acade') ? 'has-error' : '' }}">
            <label for="cep_acade">Cep</label>
            {!! Form::text('cep_acade',null,['class'=>'form-control cep']) !!}
            @if ($errors->has('cep_acade'))
              <span class="help-block">
                            <strong>{{ $errors->first('cep_acade') }}</strong>
                        </span>
            @endif
          </div>


          <div
            class="form-group col-md-6 input-group-sm has-feedback {{ $errors->has('cidade_id') ? 'has-error' : '' }}">
            <label for="cidade_id">Cidade</label>
            {!! Form::select('cidade_id', $cidades, null, ['class'=> 'form-control select2']) !!}
            @if ($errors->has('cidade_id'))
              <span class="help-block">
                            <strong>{{ $errors->first('cidade_id') }}</strong>
                        </span>
            @endif
          </div>
        </div>

        <div class=" box-footer ">
          <div style="float: left">
            <a href="{{route('academia.index')}}" class="btn btn-danger btn-sm"><i class="fa fa-times"></i>
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
