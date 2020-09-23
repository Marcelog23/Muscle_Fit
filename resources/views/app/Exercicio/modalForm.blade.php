<!-- Modal -->
<div class="modal fade" id="modalExercicio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Manutenção De Exercícios</h4>
      </div>
      <div class="modal-body">
        <div>
                {!! Form::open(['class'=>'form form-search form-ds','id'=>'frmExercicios']) !!}

            <div class="row">
                <div class="form-group col-md-2 input-group-sm">
                    <label for="id">Código</label>
                        {!! Form::text('id', null, ['class'=> 'form-control','readonly'=>'true','id'=>'id' ]) !!}
                        {!! Form::hidden('codg_exrc', 0, ['class'=> 'form-control','readonly'=>'true','id'=>'codg_exrc' ]) !!}
                        <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
                </div>


                <div class="form-group col-md-10 input-group-sm has-feedback {{ $errors->has('nome_exrc') ? 'has-error' : '' }}">
                    <label for="nome_exrc">Nome Exercício</label>
                    {!! Form::text('nome_exrc',  null, ['class'=>'form-control ','onkeyup'=>'value=value.toUpperCase()','required','id'=>'nome_exrc']) !!}
                    @if ($errors->has('nome_exrc'))
                        <span class="help-block">
                <strong>
                {{ $errors->first('nome_exrc') }}
                </strong>
                </span>
                    @endif
                </div>

            </div>

            <div class=" box-footer">
                <div style="float: left">
                    <button class="btn btn-danger btn-sm" data-dismiss="modal" id="btnCancel"><i class="fa fa-times"></i>
                        Cancelar</button>
                </div>
                <div style="float: right">
                    <button type="submit" class="btn btn-primary btn-light-blue btn-sm" id="btnSubmit"><i class="fa fa-check"></i>Cadastrar </button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
      </div>
    </div>
  </div>
</div>
