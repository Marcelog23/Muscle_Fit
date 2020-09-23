@extends('content')
@section('title', "Gestão da Academia")
@section('content')

  <div>
    <div class="box box-danger">
      <div class="box-header">
        <h4><b>Gestão da Academia</b>

          <a href="{{route('academia.create')}}" style="float: right;" type="button"
             class="btn btn-primary "><i class="fa fa-plus"></i> Novo </a>

        </h4>

      </div>
      <hr class="linha">
      <div class="box-body">
        <div class="table-responsive-sm">

          <table class="table table-hover table-striped table-sm ">
            <thead>
            <tr>
              <th>Razão Social</th>
              <th>Nome Fant.</th>
              <th>End.</th>
              <th>Fone</th>
              <th>E-mail</th>
              <th>CNPJ</th>
              <th style="text-align: center">Ação</th>
            </tr>
            </thead>
            <tbody>
            @forelse($academias as $a)
              <tr>
                <td>{{$a->razao_social}}</td>
                <td>{{$a->nome_fant}}</td>
                <td>{{$a->endr_acade}}</td>
                <td>{{ preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1)$2-$3', $a->telf_acade) }}</td>
                <td>{{$a->email_acade}}</td>
                <td>{{ preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3.$4-$5', $a->cnpj_acade) }} </td>
                <td align="center">

                  <a href="{{route('academia.edit', $a->id)}}" type="button" class="btn btn-primary btn-xs"
                     data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>

                  <!-- MODAL EXCLUIR -->
                  <a title="Excluir" class="btn btn-danger btn-xs" type="button"
                     data-toggle="modal" data-target="#id{{$a->id}}">
                    <i class="fa fa-trash"></i> </a>


                  <div class="modal modal-info fade" data-backdrop="static" id="id{{ $a->id}}" tabindex="-1"
                       role="dialog"
                       aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="box box-danger">
                        <div class="box-header">
                          <button type="button" class="close" data-dismiss="modal"
                                  aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <h4 class="modal-title text-center" id="myModalLabel">
                            <b> Exclusão da Academia:</b> <br/> {{$a->nome_fant}}
                          </h4>
                        </div>
                        <div class="box-body">
                          <b> Tem certeza que deseja excluir? </b>
                        </div>
                        <div class=" box-footer">
                          <form action="{{route('academia.destroy', [$a->id] )}}">
                            {{method_field('delete')}}

                            <div style="float: left">
                              <a class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i>
                                Cancelar</a>
                            </div>
                            <div style="float: right">
                              <button type="submit" class="btn btn-primary btn-light-blue btn-sm"><i
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
        </div>
      </div>
    </div>
  </div>
@endsection
