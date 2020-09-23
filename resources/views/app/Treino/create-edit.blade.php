@extends('content')
@section('title', "Manutenção do Treinos")

@section('content')

    <div>
        <div class="box box-danger">
            <div class="box-header  ">
                <h4><b>Manutenção do Treinos</b></h4>
            </div>
            <hr class="linha">
            <div class="box-body">

                @if(isset($errors) && $errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(isset($treino))
                    {!! Form::model($treino,['route'=>['treino.update', $treino->id], 'class'=>'form form-search form-ds', 'method'=>'PUT', 'id'=>'frmEdit']) !!}
                @else
                    {!! Form::open(['route'=>'treino.store', 'class'=>'form form-search form-ds']) !!}
                @endif


                <div class="row">
                    <div class="form-group col-md-2 input-group-sm">
                        <label for="id">Código</label>
                        @if(isset($codigo))
                            {!! Form::text('codg_trno', $codigo, ['class'=> 'form-control','readonly'=>'true' ]) !!}
                        @else
                            {!! Form::text('codg_trno', null, ['class'=> 'form-control','readonly'=>'true' ]) !!}
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 input-group-sm">
                        <label for="matricula_id">Matricula/Aluno</label>
                        @if(isset($edit))
                            {!! Form::select('matricula_id',$matricula, null,['class'=>'form-control','style'=>'height: 35px;border-radius:unset', 'required','disabled']) !!}
                         @else
                            {!! Form::select('matricula_id',$matricula, null,['class'=>'form-control select2 foco','placeholder' => 'Selecione', 'required', 'id'=> 'matricula_id']) !!}
                        @endif
                    </div>

                    <div class="form-group col-md-6 input-group-sm">
                        <label for="dia_sema">Dia Semana</label>
                        @if(isset($diaSemana))
                            {!! Form::select('dia_sema', $diaSemana, null,['class'=>'form-control','disabled', 'style'=>'height: 35px;border-radius:unset']) !!}
                        @else
                            <select class="form-control" id="dia_semana" name="dia_sema" required="required" disabled="disabled" style="height: 35px;border-radius:unset ">
                                <option selected>Selecione..</option>
                            </select>
                        @endif
                    </div>
                </div>
                <div class="row container-fluid">

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExercicio" style="float: right;">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Adicionar Exercício
                    </button>
                </div>

                    <br/>

                <div>
                    <table id="tblExer" class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th></th>
                            <th style="width: 10%; text-align: center">Código</th>
                            <th style="width: 50%">Nome Treino</th>
                            <th style="text-align: center">Nº. Repetições</th>
                            <th style="text-align: center">N°. Série</th>
                            <th style="text-align: center">Tempo Int.</th>
                            <th>Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($exerEdit))
                            @foreach($exerEdit as $e)
                            <tr>
                              <td><input type="hidden" name="exercicios[]" id="exercicio_id" value="{{$e->id}}"                class="form-control-sm"  readonly="true"  style="width:100%"></td>
                              <td><input type="text"   name="codigo"       id="codg_exrc"    value="{{$e->codg_exrc}}"         class="form-control-sm" style="width:100%; text-align: center;"  readonly="true" style="width:100%"></td>
                              <td><input type="text"   name="nome"         id="nome_exrc"    value="{{$e->nome_exrc}}"         class="form-control-sm"  readonly="true" style="width:100%"></td>
                              <td><input type="number" name="numr_rept[]"  id="numr_rept"    value="{{$e->pivot->numr_rept}}"  class="form-control-sm"  style="width:100%; text-align: center;"></td>
                              <td><input type="number" name="numr_sers[]"  id="numr_sers"    value="{{$e->pivot->numr_sers}}"  class="form-control-sm"  style="width:100%; text-align: center;"></td>
                              <td><input type="number" name="temp_intr[]"  id="temp_intr"    value="{{$e->pivot->temp_intv}}"  class="form-control-sm"  style="width:100%; text-align: center;"></td>
                                <td align="center">
                                    <button class="btn btn-danger btn-xs white-text" title="Remover" onclick="$(this).parent().parent().remove()" ><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                </div>

                <div class=" box-footer ">
                    <div style="float: left">
                        <a href="{{route('treino.index')}}" class="btn btn-danger btn-sm"><i class="fa fa-times"></i>
                            Cancelar</a>
                    </div>
                    <div style="float: right">
                        <button type="submit" class="btn btn-primary btn-light-blue btn-sm salvar"><i class="fa fa-check"></i>
                            Confirmar
                        </button>
                    </div>
                </div>


            </div>

            {!! Form::close() !!}
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalExercicio" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="box box-danger">
                <div class="box-header">
                    <h3>Seleção de Exercícios <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></h3>
                </div>
                <div class="box-body">
                    <div class="well well-sm input-group-sm">
                        <input type="text" class="form-control" placeholder="Informe um ID ou Nome.." id="busca" >
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table  table-striped table-hover table-sm " id="tblExercicios" style="width:100%;">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th style="text-align: center; width: 10%">Ação</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class=" box-footer">
                        <div style="float: left">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i>
                                Cancelar</button>
                        </div>
                        <div style="float: right">
                            <button type="button" class="btn btn-primary btn-sm btn-light-blue" id="btnSaveExer" ><i class="fa fa-check"></i>
                                Selecionar
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>
        $(document).ready(function () {

            var routeGetExer = "{{route('treino.getExercicios')}}";
            var dataTable =  $('#tblExercicios').DataTable({
              processing:   true,
              serverSide:   true,
              lengthChange: false,
              ordering:     false,
                ajax:{
                    url: routeGetExer,
                    data:function(data){
                      //instancia o objeto DataTable, pegando as informações da pagina
                      var pageInfo = $('#tblExercicios').DataTable().page.info();
                      //faz uma copia do objeto data, soma 1 para a primeira pagina
                      return $.extend({},data,{
                        page: pageInfo.page + 1,
                        extra_search: $('#extra').val()
                      });
                    },
                    //metodo de conf de respostas do servidor
                    dataSrc: function(json){
                      json.recordsTotal    = json.total;
                      json.recordsFiltered = json.total;
                      return json.data;
                    },

                },
                columns:[
                    {title: 'ID',     data:'codg_exrc'},
                    {title: 'Nome',   data:'nome_exrc'},
                    {title: 'Ação',   defaultContent:''},
                ],
                language:{
                      info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                      lengthMenu: "Mostrando _MENU_ registros",
                      infoEmpty: "Sem Registros",
                      emptyTable: "Nenhum Registro para Exibição",
                      search: "Busca",
                      paginate:{
                       first:'<<',
                       last:'>>',
                       previous:'<',
                       next:'>'
                    }
                }
            });

            $('#tblExercicios').on('click', 'tbody tr', function(){

                dataTable.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');

                 //pega a linha, após busca os dados da linha
                 var tr  = $(this).closest('tr');
                 var row = dataTable.row(tr).data();

                //evento de duplo click
                $('#tblExercicios').off('dblclick');
                $('#tblExercicios').on( 'dblclick', 'tr', function () {

                  if ( $(this).hasClass('selected') ) {
                       $(this).removeClass('selected');
                  }
                    montaDadosLinha(row);
                });

               //evento no clique ao salvar a pessoa na modal
               $('#btnSaveExer').off('click');
               $('#btnSaveExer').on('click', function(){
                   montaDadosLinha(row);
               });


            });

            const montaDadosLinha = (row) =>{
                montaLinhaTabela();
                $('#exercicio_id').val(row.id);
                $('#codg_exrc').val(row.codg_exrc);
                $('#nome_exrc').val(row.nome_exrc);
                $('#modalExercicio').modal('hide');
                $('#modalExercicio').on('hidden.bs.modal', function(e){
                  $('#numr_rept').focus();
                });
            }


            const montaLinhaTabela = () =>{
              var newRow = $('<tr>');
              var cols = "";

              cols += '<td><input type="hidden" name="exercicios[]" id="exercicio_id" class="form-control-sm" readonly="true"  ></td>';
              cols += '<td><input type="text"   name="codigo"       id="codg_exrc" class="form-control-sm"    style="width:100%; text-align: center;" readonly="true" style="width:100%"></td>';
              cols += '<td><input type="text"   name="nome"         id="nome_exrc" class="form-control-sm"    readonly="true" style="width:100%"></td>';
              cols += '<td><input type="number" name="numr_rept[]"  id="numr_rept" class="form-control-sm"    style="width:100%; text-align:center;" required ></td>';
              cols += '<td><input type="number" name="numr_sers[]"  id="numr_sers" class="form-control-sm"    style="width:100%; text-align: center;" required></td>';
              cols += '<td><input type="number" name="temp_intr[]"  id="temp_intr" class="form-control-sm"    style="width:100%; text-align: center;" required ></td>';
              cols += '<td align="center">';
              cols += '<button class="btn btn-danger btn-xs white-text" title="Remover" onclick="RemoveTableRow(this)" type="button"><i class="fa fa-trash" aria-hidden="true"></button>';
              cols += '</td>';

              newRow.append(cols);
              $('#tblExer').prepend(newRow);
              return false;
            }

            //remove a linha
             RemoveTableRow = function(item){
                let tr = $(item).closest('tr');
                tr.fadeOut(400, function () {
                    tr.remove();
                    return false;
                });
                return false;
            };



            $('#matricula_id').on('change', function (e) {

                // habilitando o campo dia semana
                $('#dia_semana').attr('disabled',false);

                var matricula = e.target.value;

                $.get("getDiaSemana/"+ matricula , function (data) {
                console.log(data);
                    $('#dia_semana').empty();
                  //  $('#dia_semana').append('<option selected>Selecione..</option>');
                    segunda = false;
                    terca   = false;
                    quarta  = false;
                    quinta  = false;
                    sexta   = false;
                    sabado  = false;
                    $.each(data, function (index, $diaObj) {
                        if($diaObj.dia_sema == 'SE'){
                            segunda = true;
                        } else if($diaObj.dia_sema == 'TE'){
                            terca  = true;
                        }else if ($diaObj.dia_sema == 'QA'){
                            quarta = true;
                        }else if ($diaObj.dia_sema == 'QI'){
                            quinta = true;
                        }else if($diaObj.dia_sema == 'SX'){
                            sexta = true;
                        }else if ($diaObj.dia_sema == 'SA'){
                            sabado = true;
                        }

                    });
                    if (segunda == false){
                        $('#dia_semana').append('<option value="SE">SEGUNDA</option>')
                    }
                    if (terca == false){
                        $('#dia_semana').append('<option value="TE">TERCA</option>')
                    }
                    if (quarta == false){
                        $('#dia_semana').append('<option value="QA">QUARTA</option>')
                    }
                    if (quinta == false){
                        $('#dia_semana').append('<option value="QI">QUINTA</option>')
                    }
                    if (sexta == false){
                        $('#dia_semana').append('<option value="SX">SEXTA</option>')
                    }
                    if (sabado == false){
                        $('#dia_semana').append('<option value="SA">SABADO</option>')
                    }

                })

            });

        });

    </script>

@endsection
