@extends('content')
@section('title', "Manutenção do Treinos")

@section('content')
    <div class="box box-danger">

        <div class="box-header">
            <div class="d-flex ">
                <div class="col-md-6">
                    <h4><b>Gestão de Treinos</b></h4>
                    @if(isset($nome))
                        <b>Aluno(a) - </b> {{$nome}}
                    @endif
                </div>
                <div class="col-md-6">
                    <div style="float: right;">
                        <a href="{{route('treino.create')}}" type="button"
                           class="btn btn-primary "><i class="fa fa-plus"></i> Novo </a>
                        <a href="{{route('treino.index')}}" type="button"
                           class="btn btn-danger"><i class="fa fa-reply"></i> Voltar </a>
                    </div>
                </div>
            </div>
        </div>

        <hr class="linha">

        <div class="box-body">

            <!-- 1° LINHA DE TABELAS -->



                <div class="col-md-6" id="boxSegunda">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title"><b>Dia da Semana: Segunda</b></h3>
                        </div>

                        <div class="box-body">
                            <div class="table-responsive-sm">
                                <table class="table table-hover table-striped table-sm " id="tblSegunda">
                                    <thead>
                                    <tr>
                                        <th>Exercício</th>
                                        <th style="text-align: center;">Repetições</th>
                                        <th style="text-align: center;">Séries</th>
                                        <th style="text-align: center;">Intervalo</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $id=NULL;
                                    @endphp
                                    @forelse($treinos as $t)
                                        @if($t->dia_sema == 'SE')
                                            @php $id = $t->id;  @endphp
                                            <tr>
                                                <td>{{$t->nome_exrc}}</td>
                                                <td style="text-align: center;">{{$t->numr_rept}}</td>
                                                <td style="text-align: center;">{{$t->numr_sers}}</td>
                                                <td style="text-align: center;">{{$t->temp_intv}}</td>
                                            </tr>
                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="200">Não Existem Registros</td>
                                        </tr>
                                    @endforelse
                                    </tbody>

                                </table>

                                @if($id)
                                    <div>
                                        <a href="{{route('treino.edit', $id)}}" type="button"
                                           class="btn btn-primary btn-sm "><i class="fa fa-edit"></i> Editar
                                        </a>

                                        <!-- MODAL EXCLUIR  -->
                                        <a title="Excluir" class="btn btn-danger btn-sm" type="button"
                                           data-toggle="modal" data-target="#id{{$id}}">
                                            <i class="fa fa-trash"></i> Excluir</a>

                                        <div class="modal modal-info fade" data-backdrop="static"
                                             id="id{{$id}}"
                                             tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="box box-danger">
                                                    <div class="box-header">
                                                        <button type="button" class="close"
                                                                data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h3 class="modal-title text-center"
                                                            id="myModalLabel">
                                                            Exclusão de Treino <br/>
                                                        </h3>
                                                    </div>
                                                    <div class="box-body text-center">
                                                        <b> Deseja excluir o treino de Segunda Feira? </b>
                                                    </div>
                                                    <div class=" box-footer">
                                                        <form action="{{route('treino.destroy', [$id] )}}">
                                                            {{method_field('delete')}}

                                                            <div style="float: left">
                                                                <a class="btn btn-danger btn-sm"
                                                                   data-dismiss="modal"><i
                                                                            class="fa fa-times"></i>
                                                                    Cancelar</a>
                                                            </div>
                                                            <div style="float: right">
                                                                <button type="submit"
                                                                        class="btn btn-primary btn-light-blue btn-sm">
                                                                    <i
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


                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                <div class=" col-md-6" id="boxTerca">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title"><b>Dia da Semana: Terça</b></h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive-sm">

                                <table class="table table-hover table-striped table-sm " id="tblTerca">
                                    <thead>
                                    <tr>
                                        <th>Exercício</th>
                                        <th style="text-align: center;">Repetições</th>
                                        <th style="text-align: center;">Séries</th>
                                        <th style="text-align: center;">Intervalo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $id=NULL;
                                    @endphp
                                    @forelse($treinos as $t)
                                        @if($t->dia_sema == 'TE')
                                            @php $id = $t->id; @endphp
                                            <tr>
                                                <td>{{$t->nome_exrc}}</td>
                                                <td style="text-align: center;">{{$t->numr_rept}}</td>
                                                <td style="text-align: center;">{{$t->numr_sers}}</td>
                                                <td style="text-align: center;">{{$t->temp_intv}}</td>
                                            </tr>
                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="200">Não Existem Registros</td>
                                        </tr>
                                    @endforelse

                                    </tbody>

                                </table>
                                @if($id)
                                    <div>
                                        <a href="{{route('treino.edit', $id)}}" type="button"
                                           class="btn btn-primary btn-sm "><i class="fa fa-edit"></i> Editar
                                        </a>

                                        <!-- MODAL EXCLUIR  -->
                                        <a title="Excluir" class="btn btn-danger btn-sm" type="button"
                                           data-toggle="modal" data-target="#id{{$id}}">
                                            <i class="fa fa-trash"></i> Excluir</a>

                                        <div class="modal modal-info fade" data-backdrop="static"
                                             id="id{{$id}}"
                                             tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="box box-danger">
                                                    <div class="box-header">
                                                        <button type="button" class="close"
                                                                data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h3 class="modal-title text-center"
                                                            id="myModalLabel">
                                                            Exclusão de Treino <br/>
                                                        </h3>
                                                    </div>
                                                    <div class="box-body text-center">
                                                        <b> Deseja excluir o treino de Terça Feira? </b>
                                                    </div>
                                                    <div class=" box-footer">
                                                        <form action="{{route('treino.destroy', [$id] )}}">
                                                            {{method_field('delete')}}

                                                            <div style="float: left">
                                                                <a class="btn btn-danger btn-sm"
                                                                   data-dismiss="modal"><i
                                                                            class="fa fa-times"></i>
                                                                    Cancelar</a>
                                                            </div>
                                                            <div style="float: right">
                                                                <button type="submit"
                                                                        class="btn btn-primary btn-light-blue btn-sm">
                                                                    <i
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
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>




            <!-- 2° LINHA DE TABELAS -->


                <div class="col-md-6" id="boxQuarta">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title"><b>Dia da Semana: Quarta</b></h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive-sm">
                                <table class="table table-hover table-striped table-sm " id="tblQuarta">
                                    <thead>
                                    <tr>
                                        <th>Exercício</th>
                                        <th style="text-align: center;">Repetições</th>
                                        <th style="text-align: center;">Séries</th>
                                        <th style="text-align: center;">Intervalo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $id=NULL;
                                    @endphp
                                    @forelse($treinos as $t)
                                        @if($t->dia_sema == 'QA')
                                            @php $id = $t->id; @endphp
                                            <tr>
                                                <td>{{$t->nome_exrc}}</td>
                                                <td style="text-align: center;">{{$t->numr_rept}}</td>
                                                <td style="text-align: center;">{{$t->numr_sers}}</td>
                                                <td style="text-align: center;">{{$t->temp_intv}}</td>
                                            </tr>
                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="200">Não Existem Registros</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                @if($id)
                                    <div>
                                        <a href="{{route('treino.edit', $id)}}" type="button"
                                           class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Editar </a>
                                        <!-- MODAL EXCLUIR  -->
                                        <a title="Excluir" class="btn btn-danger btn-sm" type="button"
                                           data-toggle="modal" data-target="#id{{$id}}">
                                            <i class="fa fa-trash"></i> Excluir</a>

                                        <div class="modal modal-info fade" data-backdrop="static"
                                             id="id{{$id}}"
                                             tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="box box-danger">
                                                    <div class="box-header">
                                                        <button type="button" class="close"
                                                                data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h3 class="modal-title text-center"
                                                            id="myModalLabel">
                                                            Exclusão de Treino <br/>
                                                        </h3>
                                                    </div>
                                                    <div class="box-body text-center">
                                                        <b> Deseja excluir o treino de Quarta Feira? </b>
                                                    </div>
                                                    <div class=" box-footer">
                                                        <form action="{{route('treino.destroy', [$id] )}}">
                                                            {{method_field('delete')}}

                                                            <div style="float: left">
                                                                <a class="btn btn-danger btn-sm"
                                                                   data-dismiss="modal"><i
                                                                            class="fa fa-times"></i>
                                                                    Cancelar</a>
                                                            </div>
                                                            <div style="float: right">
                                                                <button type="submit"
                                                                        class="btn btn-primary btn-light-blue btn-sm">
                                                                    <i
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
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>


                <div class=" col-md-6">

                    <div class="box box-danger" id="boxQuinta">
                        <div class="box-header">
                            <h3 class="box-title"><b>Dia da Semana: Quinta</b></h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive-sm">

                                <table class="table table-hover table-striped table-sm " id="tblQuinta">
                                    <thead>
                                    <tr>
                                        <th>Exercício</th>
                                        <th style="text-align: center;">Repetições</th>
                                        <th style="text-align: center;">Séries</th>
                                        <th style="text-align: center;">Intervalo</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @php
                                        $id=NULL;
                                    @endphp
                                    @forelse($treinos as $t)
                                        @if($t->dia_sema == 'QI')
                                            @php $id = $t->id; @endphp
                                            <tr>

                                                <td>{{$t->nome_exrc}}</td>
                                                <td style="text-align: center;">{{$t->numr_rept}}</td>
                                                <td style="text-align: center;">{{$t->numr_sers}}</td>
                                                <td style="text-align: center;">{{$t->temp_intv}}</td>

                                                <td style="text-align: center;">


                                                </td>
                                            </tr>
                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="200">Não Existem Registros</td>
                                        </tr>
                                    @endforelse

                                    </tbody>

                                </table>
                                @if($id)
                                    <div>
                                        <a href="{{route('treino.edit', $id)}}" type="button"
                                           class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Editar </a>

                                        <!-- MODAL EXCLUIR  -->
                                        <a title="Excluir" class="btn btn-danger btn-sm" type="button"
                                           data-toggle="modal" data-target="#id{{$id}}">
                                            <i class="fa fa-trash"></i> Excluir</a>

                                        <div class="modal modal-info fade" data-backdrop="static"
                                             id="id{{$id}}"
                                             tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="box box-danger">
                                                    <div class="box-header">
                                                        <button type="button" class="close"
                                                                data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h3 class="modal-title text-center"
                                                            id="myModalLabel">
                                                            Exclusão de Treino <br/>
                                                        </h3>
                                                    </div>
                                                    <div class="box-body text-center">
                                                        <b> Deseja excluir o treino de Quinta Feira? </b>
                                                    </div>
                                                    <div class=" box-footer">
                                                        <form action="{{route('treino.destroy', [$id] )}}">
                                                            {{method_field('delete')}}

                                                            <div style="float: left">
                                                                <a class="btn btn-danger btn-sm"
                                                                   data-dismiss="modal"><i
                                                                            class="fa fa-times"></i>
                                                                    Cancelar</a>
                                                            </div>
                                                            <div style="float: right">
                                                                <button type="submit"
                                                                        class="btn btn-primary btn-light-blue btn-sm">
                                                                    <i
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
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>




            <!-- 3° LINHA DE TABELAS -->



                <div class="col-md-6" id="boxSexta">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title"><b>Dia da Semana: Sexta</b></h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive-sm">
                                <table class="table table-hover table-striped table-sm " id="tblSexta">
                                    <thead>
                                    <tr>
                                        <th>Exercício</th>
                                        <th style="text-align: center;">Repetições</th>
                                        <th style="text-align: center;">Séries</th>
                                        <th style="text-align: center;">Intervalo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $id=NULL;
                                    @endphp
                                    @forelse($treinos as $t)
                                        @if($t->dia_sema == 'SX')
                                            @php $id = $t->id; @endphp
                                            <tr>
                                                <td>{{$t->nome_exrc}}</td>
                                                <td style="text-align: center;">{{$t->numr_rept}}</td>
                                                <td style="text-align: center;">{{$t->numr_sers}}</td>
                                                <td style="text-align: center;">{{$t->temp_intv}}</td>
                                            </tr>
                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="200">Não Existem Registros</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                @if($id)
                                    <div>
                                        <a href="{{route('treino.edit', $id)}}" type="button"
                                           class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Editar </a>

                                        <!-- MODAL EXCLUIR  -->
                                        <a title="Excluir" class="btn btn-danger btn-sm" type="button"
                                           data-toggle="modal" data-target="#id{{$id}}">
                                            <i class="fa fa-trash"></i> Excluir</a>

                                        <div class="modal modal-info fade" data-backdrop="static"
                                             id="id{{$id}}"
                                             tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="box box-danger">
                                                    <div class="box-header">
                                                        <button type="button" class="close"
                                                                data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h3 class="modal-title text-center"
                                                            id="myModalLabel">
                                                            Exclusão de Treino <br/>
                                                        </h3>
                                                    </div>
                                                    <div class="box-body text-center">
                                                        <b> Deseja excluir o treino de Sexta Feira? </b>
                                                    </div>
                                                    <div class=" box-footer">
                                                        <form action="{{route('treino.destroy', [$id] )}}">
                                                            {{method_field('delete')}}

                                                            <div style="float: left">
                                                                <a class="btn btn-danger btn-sm"
                                                                   data-dismiss="modal"><i
                                                                            class="fa fa-times"></i>
                                                                    Cancelar</a>
                                                            </div>
                                                            <div style="float: right">
                                                                <button type="submit"
                                                                        class="btn btn-primary btn-light-blue btn-sm">
                                                                    <i
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
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                <div class=" col-md-6" id="boxSabado">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title"><b>Dia da Semana: Sábado</b></h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive-sm">

                                <table class="table table-hover table-striped table-sm " id="tblSabado">
                                    <thead>
                                    <tr>
                                        <th>Exercício</th>
                                        <th style="text-align: center;">Repetições</th>
                                        <th style="text-align: center;">Séries</th>
                                        <th style="text-align: center;">Intervalo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $id=NULL;
                                    @endphp
                                    @forelse($treinos as $t)
                                        @if($t->dia_sema == 'SA')
                                            @php $id = $t->id; @endphp
                                            <tr>
                                                <td>{{$t->nome_exrc}}</td>
                                                <td style="text-align: center;">{{$t->numr_rept}}</td>
                                                <td style="text-align: center;">{{$t->numr_sers}}</td>
                                                <td style="text-align: center;">{{$t->temp_intv}}</td>
                                            </tr>
                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="200">Não Existem Registros</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                @if($id)
                                    <div>
                                        <a href="{{route('treino.edit', $id)}}" type="button"
                                           class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Editar </a>

                                        <!-- MODAL EXCLUIR  -->
                                        <a title="Excluir" class="btn btn-danger btn-sm" type="button"
                                           data-toggle="modal" data-target="#id{{$id}}">
                                            <i class="fa fa-trash"></i> Excluir</a>

                                        <div class="modal modal-info fade" data-backdrop="static"
                                             id="id{{$id}}"
                                             tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="box box-danger">
                                                    <div class="box-header">
                                                        <button type="button" class="close"
                                                                data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h3 class="modal-title text-center"
                                                            id="myModalLabel">
                                                            Exclusão de Treino <br/>
                                                        </h3>
                                                    </div>
                                                    <div class="box-body text-center">
                                                        <b> Deseja excluir o treino de Sábado? </b>
                                                    </div>
                                                    <div class=" box-footer">
                                                        <form action="{{route('treino.destroy', [$id] )}}">
                                                            {{method_field('delete')}}

                                                            <div style="float: left">
                                                                <a class="btn btn-danger btn-sm"
                                                                   data-dismiss="modal"><i
                                                                            class="fa fa-times"></i>
                                                                    Cancelar</a>
                                                            </div>
                                                            <div style="float: right">
                                                                <button type="submit"
                                                                        class="btn btn-primary btn-light-blue btn-sm">
                                                                    <i
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

                                    </div>
                                @endif
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


            if (jQuery("#tblSegunda tbody tr").children().length <= 0) {

                $('#boxSegunda').addClass('hide');
            }
            if (jQuery("#tblTerca tbody tr").children().length <= 0) {

                $('#boxTerca').addClass('hide');
            }
            if (jQuery("#tblQuarta tbody tr").children().length <= 0) {

                $('#boxQuarta').addClass('hide');
            }
            if (jQuery("#tblQuinta tbody tr").children().length <= 0) {

                $('#boxQuinta').addClass('hide');
            }
            if (jQuery("#tblSexta tbody tr").children().length <= 0) {

                $('#boxSexta').addClass('hide');
            }
            if (jQuery("#tblSabado tbody tr").children().length <= 0) {

                $('#boxSabado').addClass('hide');
            }

        })

    </script>

@endsection
