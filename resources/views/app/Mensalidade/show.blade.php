@extends('content')
@section('title', "Manutenção de Mensalidades")

@section('content')

    <div>

        <div class="box box-danger">
            <div class="box-header">
                <h4><b>Manutenção de Mensalidades </b>
                    <a href="{{route('mensalidade')}}" class="btn btn-danger btn-sm" title="Voltar"
                       style="float: right"><i class="fa fa-reply"></i> Voltar</a>
                </h4>
                <b>Aluno(a) - </b>@foreach($aluno as $al)
                    {{$al->nome_aluno}}
                @endforeach
            </div>

            <hr class="linha">
            <div class="box-body">
                <div class="table-responsive-sm">


                    <table class="table table-hover table-striped table-sm ">
                        <thead>
                        <tr>
                            <th>Data Venc.</th>
                            <th>Parcela R$</th>
                            <th>Saldo R$</th>
                            <th>Status</th>
                            <th>Receber</th>

                        </tr>
                        </thead>
                        <tbody>
                        @forelse($mensalidades as $m)
                            <tr>
                                <td>{{formatDateAndTime($m->data_venc,'d/m/Y')}}</td>
                                <td>{{number_format($m->valr_mensa,2,',','.')}}</td>
                                <td>{{number_format($m->saldo_mensa,2,',','.')}}</td>
                                <td>{{$m->quitada == 1 ? 'Paga' : 'Pendente'}}</td>
                                <td>
                                    <button type="submit" class="btn btn-success btn-xs" data-placement="top"
                                            data-toggle="modal" data-target="#modalPagamento{{$m->id}}"
                                            title="Receber"><i class="fa fa-money"></i></button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalPagamento{{$m->id}}" tabindex="-1" role="dialog"
                                         data-backdrop="static" aria-hidden="true">
                                        <div class="modal-dialog" role="document" style="width: 35%;">
                                            <div class="box box-danger">

                                                <div class="box-body">

                                                    <div class="box-header">
                                                        <h3>Pagamento Mensalidade
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </h3>
                                                    </div>
                                                    <hr class="linha">
                                                    <div class="box-body">

                                                            @if(isset($errors) && $errors->any())
                                                                <div class="alert alert-danger  " role="alert">
                                                                    <ul>
                                                                        @foreach($errors->all() as $error)
                                                                            <li>{{$error}}</li>
                                                                        @endforeach
                                                                        <button type="button" class="close"
                                                                                data-dismiss="alert" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </ul>
                                                                </div>
                                                            @endif

                                                            {!! Form::open(['route'=>'mensalidade.receber', 'class'=>'form form-search form-ds']) !!}

                                                            <div class="row">
                                                                <div class="form-group col-md-6 input-group-sm">
                                                                    <label for="data_pagt">Data Vencimento</label>
                                                                    {!! Form::date('data_pagt',$m->data_venc, ['class'=>'form-control','readonly']) !!}
                                                                </div>
                                                                <div class="form-group col-md-6 input-group-sm">
                                                                    <label for="data_pagt">Data Lançamento</label>
                                                                    {!! Form::date('data_pagt', \Carbon\Carbon::now(), ['class'=>'form-control']) !!}
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group col-md-6 input-group-sm">
                                                                    <label for="valr_plan">Valor</label>
                                                                    {!! Form::text('saldo_mensa',number_format($m->saldo_mensa,2,',','.') ,['class'=>'form-control money']) !!}
                                                                </div>
                                                                <div class="form-group col-md-6 input-group-sm">
                                                                    <label for="tipo_lanc">Forma Pagamento</label>
                                                                    {!! Form::select('forma_pagamento_id',$formas, null, ['class'=>'form-control']) !!}
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <input name="idMensalidade" type="hidden"
                                                                       value="{{$m->id}}">
                                                            </div>

                                                            <div class=" box-footer ">
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
                                                                        Receber
                                                                    </button>
                                                                </div>
                                                            </div>

                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- fim da modal -->


                                </td>
                            </tr> <!-- fim da linha -->
                        @empty
                            <tr>
                                <td colspan="200">Não Existem Registros</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{$mensalidades->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
