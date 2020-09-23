@extends('content')
@section('title', "Gestão de Exercicios")

@section('content')


    <div>
        <div class="box box-danger">
          <div class="box-header">
              <h4 ><b>Gestão de Exercicios</b>
                <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#modalExercicio" style="float: right;">
                  <i class="fa fa-plus"></i>  Novo
                </button></h4>
          </div>

            <hr class="linha">

            <div class="box-body">
                <div class="table-responsive-sm">

                    {!! Form::open(['name'=> 'form_search', 'route'=>'exercicio']) !!}
                    <div class="well well-sm input-group input-group-sm">
                        <input type="text" class="form-control foco" name="filtro" placeholder="Informe um ID ou Nome.."
                               id="busca">
                        <span class="input-group-btn">
                            <button type="submit" name="search" class="btn btn-primary"><i
                                        class="fa fa-search"></i></button>
                        </span>
                    </div>
                    {!! Form::close() !!}

                    <table class="table table-hover table-striped table-sm sorttable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th style="text-align: center">Ação</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($exercicios as $exer)
                            <tr>
                                <td>{{$exer->codg_exrc}}</td>
                                <td>{{$exer->nome_exrc}}</td>
                                <td align="center">
                                    <a onclick="editData({{$exer->id}})"  type="button"
                                       class="btn btn-primary btn-xs"  data-toggle="modal" data-target="#modalExercicio"
                                       title="Editar"><i class="fa fa-edit"></i></a>

                                    <!-- MODAL EXCLUIR -->
                                    <a title="Excluir" class="btn btn-danger btn-xs" type="button"
                                       data-toggle="modal" data-target="#id{{$exer->id}}">
                                        <i class="fa fa-trash"></i> </a>


                                    <div class="modal modal-info fade" data-backdrop="static" id="id{{ $exer->id}}"
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
                                                        Exclusão de Exercício:<br/> {{$exer->nome_exrc}}
                                                    </h4>
                                                </div>
                                                <div class="box-body">
                                                    Tem certeza que deseja excluir?
                                                </div>
                                                <div class=" box-footer">
                                                    <form action="{{route('exercicio.destroy', [$exer->id] )}}">
                                                        {{method_field('delete')}}

                                                        <div style="float: left">
                                                            <a class="btn btn-danger btn-sm" data-dismiss="modal"><i
                                                                        class="fa fa-times"></i>
                                                                Cancelar</a>
                                                        </div>
                                                        <div style="float: right">
                                                            <button type="submit"
                                                                    class="btn btn-primary btn-light-blue btn-sm"><i
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

                    {{$exercicios->links()}}
                </div>
            </div>
        </div>
    </div>

  @include('app.exercicio.modalForm')

@endsection

@section('js')
  <script type="text/javascript">

      $(document).ready(function(){

        $('#modalExercicio').on('shown.bs.modal', function (e) {
            $('#nome_exrc').focus();
        });

        $( '#btnSubmit').on('click', function(e){
          //e.preventDefault();
          let route = "{{route('exercicio.store')}}";
          var token = $("input[name=_token]").val();
          var id = $('#id').val();

            if (id === '' || id === null) {
              $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN':token},
                type:'POST',
                datatype:'json',
                data: $('#frmExercicios').serialize(),
                success:function(data){
                  console.log(data);
                    if(data.success === 'true'){
                        $('#modalExercicio').modal('toggle');
                        $('#frmExercicios')[0].reset();
                        document.location.href = '{{route('exercicio')}}';
                    }
                },
                error:function(data){
                  console.log(data);
                }
              });
            }else{
              let id = $('#id').val();
              let routeEdit = "{{url('exercicio')}}/"+id+"/update";
              let token = $("input[name=_token]").val();
              $.ajax({
                url: routeEdit,
                headers: {'X-CSRF-TOKEN':token},
                type:'PUT',
                datatype:'json',
                data: $('#frmExercicios').serialize(),
                success:function(data){
                    if(data.success === 'true'){
                        $('#modalExercicio').modal('toggle');
                        $('#frmExercicios')[0].reset();
                        document.location.href = '{{route('exercicio')}}';
                    }
                },
                error:function(data){
                  console.log(data);
                }
              });
            }

        });

        //validações
        $('#frmExercicios').validate();




      });

      function editData(id){
        let route = "{{url('exercicio')}}/"+id+"/edit";
        $.get(route, function(data){
            $('#id').val(data.id);
            $('#codg_exrc').val(data.codg_exrc);
            $('#nome_exrc').val(data.nome_exrc).select();
        });
      }

      const resetData = ()=>{
        $('#id').val('');
        $('#codg_exrc').val('');
        $('#nome_exrc').val('');
      }

      let btnCancel = document.getElementById('btnCancel');
      btnCancel.addEventListener('click', resetData, false);

  </script>
@endsection
