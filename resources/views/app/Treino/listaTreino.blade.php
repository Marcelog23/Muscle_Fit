<!DOCTYPE html>
<html>
<head>
    <title>Listagem dos Treinos</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>


<div class="col-md-6">
    @foreach ($academia as $acade)
        <div class="container-fluid">
            <div class="row">
                <div>
                    <h5><b> {{$acade->nome_fant}}</b></h5>
                    Fone: {{formataFoneFixo($acade->telf_acade)}} <br/>
                    <b>Aluno(a) - {{$aluno}}</b>
                </div>
                <div style="float: right;">
                    End: {{$acade->endr_acade}} <br>
                    E-mail: {{$acade->email_acade}}
                </div>
            </div>
        </div>
    @endforeach
</div>

<br>
<br>
<br>

<hr class="linha">


<div >
    <h5 ><b>Dia da Semana: Segunda</b></h5>
</div>
<div>
    <div>

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

            @forelse($treinos as $t)

                @if($t->dia_sema == 'SE')
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
    </div>
</div>


<div >
    <h5 ><b>Dia da Semana: Terça</b></h5>
</div>
<div >
    <div >

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

            @forelse($treinos as $t)

                @if($t->dia_sema == 'TE')
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
    </div>
</div>


<div >
    <h5 ><b>Dia da Semana: Quarta</b></h5>
</div>
<div >
    <div >
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
            @forelse($treinos as $t)
                @if($t->dia_sema == 'QA')
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
    </div>
</div>


<div >
    <h5 ><b>Dia da Semana: Quinta</b></h5>
</div>
<div >
    <div >

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
            @forelse($treinos as $t)
                @if($t->dia_sema == 'QI')
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
    </div>
</div>


<!-- 3° LINHA DE TABELAS -->


<div >
    <h5 ><b>Dia da Semana: Sexta</b></h5>
</div>
<div >
    <div >
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
            @forelse($treinos as $t)
                @if($t->dia_sema == 'SX')
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

    </div>
</div>


<div >
    <h5 ><b>Dia da Semana: Sábado</b></h5>
</div>
<div >
    <div >
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
            @forelse($treinos as $t)
                @if($t->dia_sema == 'SA')
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
    </div>
</div>

<footer style="position: absolute; bottom: 0px">
    <hr>
    <div class="text-center">
        Hashtag Soluções <i>Web</i> - Muscle<i>&Fit</i>
    </div>
</footer>


</body>

</html>
